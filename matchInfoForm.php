<?php

    if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";


        // events_organised Table ------------------------------------------------------------------------------------------
        $event_ID = $_POST['eventID'];

        $eventInfo = "SELECT eventID AS eventID
                    FROM events_organised WHERE eventID = '$event_ID'";

        $result = mysqli_query($conn, $eventInfo);
        $info = mysqli_fetch_assoc($result);

        if(!empty($info['eventID'])){
            // matches Table ---------------------------------------------------------------------------------------------------
            $venue = $_POST['venue'];
            $match_date = $_POST['matchDate'];
            $match_ID = $_POST["matchID"];
            $mvp = $_POST["MVP"];
            $batting_first = $_POST["battingFirst"];
            $bowling_first = $_POST["bowlingFirst"];


            $matchQuery = "INSERT INTO matches (matchID, eventID, venue, date_of_match, man_of_the_match, team_batting_first, team_bowling_first)
                        VALUES ('$match_ID', '$event_ID', '$venue', '$match_date', '$mvp', '$batting_first', '$bowling_first')";

            commitTable($conn, $matchQuery);
        }
        else{
            echo "<script> alert('Event does not exist.'); </script>";
        }
        

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
    <li><a href="teamInfoForm.php">Team Registration Form</a></li>
    <li><a class="active" href="matchInfoForm.php">Match Registration Form</a></li>
</ul>

<body>

<div class="forms">
    <form class="forms" action="matchInfoForm.php" method="post">

        <h4 class="headers">Match Information </h4>
        Venue: <input type="TEXT" name="venue" title="Venue" placeholder="Venue"><br><br>
        Date of the match: <input type="date" name="matchDate" title="Date of the match"><br><br>


        <h4 class="headers">Event Information </h4>
        Event ID: <input type="number" name="eventID" title="Event ID" placeholder="Event ID"><br><br>

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
