<?php

    if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";


        // Clubs Table -------------------------------------------------------------------------------------------------
        $club_name = $_POST['clubName'];
        $date_established = $_POST['dateEstablished'];
        $president_name = $_POST['president'];

        // Insert into the players table
        $playerQuery = "INSERT INTO clubs (club_name, president, date_established) 
		VALUES ('$club_name', '$president_name', '$date_established')";

        commitTable($conn, $playerQuery);

        mysqli_close($conn);
    }
?>

<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">

<head>
    <meta charset="UTF-8">
	<title>Club Registration Form</title>
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li><a class="active" href="playerRegistration.php">Registration</a></li>
    <li><a href="playerSearch.php">Information</a></li>
</ul>

<div class="clubPage">
    <h1 class="pageName">Club Registration Form</h1>
</div>

<ul class="subMenu">
    <li><a href="playerRegistration.php">Player Registration</a></li>
    <li><a class="active" href="clubRegistration.php">Club Registration</a></li>
    <li><a href="teamInfoForm.php">Team Information Form</a></li>
    <li><a href="matchInfoForm.php">Match Information Form</a></li>
</ul>

<body>

<div class="forms">
	<form class="forms" action="clubRegistration.php" method="post">

        <h4 class="headers">General Information </h4>
        Name of the club: <input type="text" name="clubName" title="Club Name" placeholder="Club Name"><br><br>
        Date of Establishment: <input type="date" name="dateEstablished" title="Date Established"><br><br>
        Name of the President: <input type="text" name="president" title="President's Name" placeholder="President's Name"><br><br>

        <input type="submit" name="submit">

    </form>
</div>

</body>

</html>