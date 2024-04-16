<?php

    if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";


        // contracts Table ---------------------------------------------------------------------------------------------
        $club_ID = $_POST['clubID'];
        $player_ID = $_POST['playerID'];
        $authorized_person = $_POST['officerFirstName'] . " " . $_POST['officerLastName'];
        $designation = $_POST['designation'];
        $start_date = $_POST['startDate'];
        $end_date = $_POST['endDate'];

        // Check if the player has a running contract with another club
        $contractExists = false;

        $getEndDate = "SELECT contract_end_date FROM contracts WHERE playerID = '$player_ID'";

        if ($result = mysqli_query($conn, $getEndDate))
        {
            if (mysqli_num_rows($result) > 0)
            {
                while ($endDt = mysqli_fetch_assoc($result))
                {
                    $date1 = new DateTime($endDt['contract_end_date']);
                    $date2 = new DateTime($start_date);

                    if($date1 > $date2)
                        $contractExists = true;
                }
            }
        }


        if ($contractExists)
        {
            echo "<script> alert('A player cannot enroll into two clubs simultaneously'); </script>";
            mysqli_close($conn);
        }
        else
        {
            // Insert into the contracts table
            $contractQuery = "INSERT INTO contracts (clubID, playerID, authorized_person, designation, contract_start_date, contract_end_date) 
                          VALUES ('$club_ID', '$player_ID', '$authorized_person', '$designation', '$start_date', '$end_date')";

            commitTable($conn, $contractQuery);

            mysqli_close($conn);
        }
    }
?>

<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">


<head>
    <meta charset="UTF-8">
	<title>Contract Form</title>
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li><a class="active" href="playerRegistration.php">Registration</a></li>
    <li><a href="playerSearch.php">Information</a></li>
</ul>

<div class="contractPage">
    <h1 class="pageName">Contract Form</h1>
</div>

<ul class="subMenu">
    <li><a href="playerRegistration.php">Player Registration</a></li>
    <li><a href="clubRegistration.php">Club Registration</a></li>
    <li><a class="active" href="contractForm.php">Contract Form</a></li>
    <li><a href="teamInfoForm.php">Team Information Form</a></li>
    <li><a href="matchInfoForm.php">Match Information Form</a></li>
</ul>

<body>

<div class="forms">
	<form class="forms" action="contractForm.php" method="post">

        <h4 class="headers">Club Information </h4>
        Club ID: <input type="number" name="clubID" title="Club ID" placeholder="Club ID"><br><br>
        Name of the club: <input type="text" name="clubName" title="Club Name" placeholder="Club Name"><br><br>

        <h4 class="headers">First Party (Player) </h4>
        First Name: <input type="text" name="playerFirstName" title="First Name" placeholder="Player's First Name"><br><br>
        Last Name: <input type="text" name="playerLastName" title="Last Name" placeholder="Player's Last Name"><br><br>
        Player ID: <input type="number" name="playerID" title="PLayer ID" placeholder="Player ID"><br><br>

        <h4 class="headers">Second Party (Authorized Person) </h4>
        First Name: <input type="text" name="officerFirstName" title="First Name" placeholder="Officer's First Name"><br><br>
        Last Name: <input type="text" name="officerLastName" title="Last Name" placeholder="Officer's Last Name"><br><br>
        Designation: <input type="text" name="designation" title="Designation" placeholder="Officer's Designation"><br><br>

        <h4 class="headers">Contract Period </h4>
        Start Date : <input type="date" name="startDate" title="Start Date"><br><br>
        End Date : <input type="date" name="endDate" title="End Date"><br><br>
        
        <input type="submit" name="submit">

    </form>
</div>

</body>

</html>
