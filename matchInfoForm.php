<?php

    if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";


        // events_organised Table ------------------------------------------------------------------------------------------
        $event_ID = $_POST['eventID'];
        $event_name = $_POST['eventName'];
        $event_start_date = $_POST['eventStart'];
        $event_end_date = $_POST['eventEnd'];

        // Insert into the events_organised table
        $eventQuery = "INSERT INTO events_organised (eventID, eventName, start_date, end_date) 
                        VALUES ('$event_ID', '$event_name', '$event_start_date', '$event_end_date')";

        commitTable($conn, $eventQuery);


        // matches Table ---------------------------------------------------------------------------------------------------
        $venue = $_POST['venue'];
        $match_date = $_POST['matchDate'];
        $match_ID = $_POST["matchID"];
        $mvp = $_POST["MVP"];
        $batting_first = $_POST["battingFirst"];
        $bowling_first = $_POST["bowlingFirst"];

        
        $matchQuery = "INSERT INTO matches (matchID, venue, date_of_match, man_of_the_match, team_batting_first, team_bowling_first)
                            VALUES ('$match_ID', '$venue', '$match_date', '$mvp', '$batting_first', '$bowling_first')";

        commitTable($conn, $matchQuery);

        mysqli_close($conn);
    }
?>

<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">

<head>
    <meta charset="UTF-8">
    <title>Match Information</title>
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li><a class="active" href="playerRegistration.php">Registration</a></li>
    <li><a href="playerSearch.php">Information</a></li>
</ul>

<div class="matchPage">
    <h1 class="pageName">Match Information Form</h1>
</div>

<ul class="subMenu">
    <li><a href="playerRegistration.php">Player Registration</a></li>
    <li><a href="clubRegistration.php">Club Registration</a></li>
    <li><a href="contractForm.php">Contract Form</a></li>
    <li><a href="teamInfoForm.php">Team Information Form</a></li>
    <li><a class="active" href="matchInfoForm.php">Match Information Form</a></li>
</ul>

<body>

<div class="forms">
    <form class="forms" action="matchInfoForm.php" method="post">

        <h4 class="headers">Match Information </h4>
        Venue: <input type="TEXT" name="venue" title="Venue" placeholder="Venue"><br><br>
        Date of the match: <input type="date" name="matchDate" title="Date of the match"><br><br>


        <h4 class="headers">Event Information </h4>
        Event ID: <input type="number" name="eventID" title="Event ID" placeholder="Event ID"><br><br>
        Event Name: <input type="text" name="eventName" title="Event Name" placeholder="Name of the Event"><br><br>
        Event Start Date: <input type="date" name="eventStart" title="Event Start Date"><br><br>
        Event End Date: <input type="date" name="eventEnd" title="Event End Date"><br><br>

        <table  id="matchTable" border = "1" cellspacing="0" cellpadding="1">
            <caption><h4 class="headers">Match Information Form</h4></caption>
            <tr>
                <th>Match ID</th>
                <th>Man-of-the match</th>
                <th>Team Batting First</th>
                <th>Team Bowling First</th>
            </tr>

            <tr>
                <td><input type="number" name="matchID" title="Match ID" required></td>
                <td><input type="text" name="MVP" title="Man-of-the match"></td>
                <td><input type="text" name="battingFirst" title="Team Batting First"></td>
                <td><input type="text" name="bowlingFirst" title="Team Bowling First"></td>
            </tr>

        </table>
        <br><br>

        <input type="submit" name="submit">

    </form>
</div>
</body>

</html>
