<?php
	
	if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";


        // Players Table -----------------------------------------------------------------------------------------------
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $date_of_birth = $_POST['dob'];
        $date_of_registration = $_POST['dor'];

        // Age of a player cannot be more than 35 years
        $date2 = date("d-m-Y");//today's date

        $date1 = new DateTime($date_of_birth);
        $date2 = new DateTime($date2);

        $interval = $date1->diff($date2);

        $age = $interval->y;

        if ($age > 35)
        {
            echo "<script> alert('Age of a player cannot be more than 35 years'); </script>";
            mysqli_close($conn);
        }

        else
        {
            // Check whether the permanent address is the same as the present address
            if (isset($_POST['sameAdrs']))
                $sameAddress = $_POST['sameAdrs'];
            else
                $sameAddress = 0;

            if ($sameAddress == 1)
                $permanentLocationID = $presentLocationID;

            // Insert into the players table
            $playerQuery = "INSERT INTO players (first_name, last_name, date_of_birth, registration_date) 
		                VALUES ('$first_name', '$last_name', '$date_of_birth', '$date_of_registration')";

            commitTable($conn, $playerQuery);


            // player_history Table ------------------------------------------------------------------------------------
            $club = array();
            $total_runs = array();
            $total_wickets = array();
            $team_leader = array();

            for ($i = 0; $i < 10; $i++)
            {
                if (isset($_POST["clubPlayedFor" . $i]))
                {
                    $club[$i] = $_POST["clubPlayedFor" . $i];
                    $total_runs[$i] = $_POST["totalRuns" . $i];
                    $total_wickets[$i] = $_POST["totalWickets" . $i];
                    $team_leader[$i] = $_POST["teamLeader" . $i];
                }
            }

            // Get player ID from players table
            $getPlayerID = "SELECT MAX(playerID) AS LastPlayerID FROM players";

            if ($result = mysqli_query($conn, $getPlayerID))
                if (mysqli_num_rows($result) > 0)
                    $pID = mysqli_fetch_assoc($result);

            // Insert into the player_history table
            if (!empty($club[0]))
            {
                $playerHistoryQuery = "INSERT INTO player_history (playerID, club_name, total_runs, total_wickets, team_leader)
                                  VALUES ('" . $pID['LastPlayerID'] . "', '$club[0]', '$total_runs[0]', '$total_wickets[0]', '$team_leader[0]')";


                for ($i = 1; $i < 10; $i++)
                {
                    if (!empty($club[$i]))
                        $playerHistoryQuery .= ", ('" . $pID['LastPlayerID'] . "', '$club[$i]', '$total_runs[$i]', '$total_wickets[$i]', '$team_leader[$i]')";
                    else
                        break;
                }
                commitTable($conn, $playerHistoryQuery);
            }
        }
    }
?>

<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">

<head>
    <meta charset="UTF-8">
	<title>Player Registration Form</title>
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li><a class="active" href="playerRegistration.php">Registration</a></li>
    <li><a href="playerSearch.php">Information</a></li>
</ul>

<div class="playerPage">
    <h1 class="pageName">Player Registration Form</h1>
</div>

<ul class="subMenu">
    <li><a class="active" href="playerRegistration.php">Player Registration</a></li>
    <li><a href="clubRegistration.php">Club Registration</a></li>
    <li><a href="contractForm.php">Contract Form</a></li>
    <li><a href="teamInfoForm.php">Team Information Form</a></li>
    <li><a href="matchInfoForm.php">Match Information Form</a></li>
</ul>

<body>

<div class="forms">
	<form class="forms" action="playerRegistration.php" method="post">

        <h4 class="headers">General Information </h4>

		First Name: <input type="text" name="firstName" title="First Name" placeholder="Your First Name" required><br><br>
		Last Name: <input type="text" name="lastName" title="Last Name" placeholder="Your Last Name" required><br><br>
		Date of Birth: <input type="date" name="dob" title="Date of Birth"><br><br>

        <table id="historyTable" border = "1" cellspacing="0" cellpadding="1">
            <caption><h4 class="headers">Previous History</h4></caption>

            <tr>
                <th>Club Name</th>
                <th>Total Runs</th>
                <th>Total Wickets</th>
                <th>Team leader (Y/N)</th>
            </tr>

            <tr>
                <td><input type="text" name="clubPlayedFor0" title="Club Name"></td>
                <td><input type="text" name="totalRuns0" title="Total Runs"></td>
                <td><input type="text" name="totalWickets0" title="Total Wickets"></td>
                <td><input type="radio" name="teamLeader0" value="Y" title="Yes"> YES<br>
                    <input type="radio" name="teamLeader0" value="N" title="No" checked> NO</td>
            </tr>

        </table>

        <br><br>
        Player Registration Date: <input type="date" name="dor" title="Player Registration Date"><br><br><br>

		<input type="submit" name="submit">

	</form>
</div>

</body>

</html>
