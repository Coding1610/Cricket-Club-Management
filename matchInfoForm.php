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
    $venue_ID = $_POST['venueID'];
    $match_date = $_POST['matchDate'];
    $match_ID = array();
    $mvp = array();
    $batting_first = array();
    $bowling_first = array();

    for ($i=0; $i<50; $i++)
    {
        if (isset($_POST["matchID" . $i]))
        {
            $match_ID[$i] = $_POST["matchID" . $i];
            $mvp[$i] = $_POST["MVP" . $i];
            $batting_first[$i] = $_POST["battingFirst" . $i];
            $bowling_first[$i] = $_POST["bowlingFirst" . $i];
        }
    }

    // Insert into the matches table
    if (!empty($match_ID[0]))
    {
        $matchQuery = "INSERT INTO matches (matchID, venueID, date_of_match, man_of_the_match, team_batting_first, team_bowling_first)
                        VALUES ('$match_ID[0]', '$venue_ID', '$match_date', '$mvp[0]', '$batting_first[0]', '$bowling_first[0]')";

        for ($i=1; $i<10; $i++)
        {
            if (!empty($match_ID[$i]))
                $matchQuery .= ", ('$match_ID[$i]', '$venue_ID', '$match_date', '$mvp[$i]', '$umpire[$i]', '$batting_first[$i]', '$bowling_first[$i]')";
            else
                break;
        }

        commitTable($conn, $matchQuery);
    }

    mysqli_close($conn);
}
?>

<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">

<script type="text/javascript">

    let matchRowCount = 2;

    function addMatchInfo()
    {
        // number of matches cannot be more than 50
        if (matchRowCount <= 50)
        {
            let table = document.getElementById("matchTable");
            let row = table.insertRow(matchRowCount);
            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);
            let cell3 = row.insertCell(2);
            let cell4 = row.insertCell(3);

            matchRowCount--;

            cell1.innerHTML = '<input type="number" name="matchID' + matchRowCount + '" title="Match ID" required>';
            cell2.innerHTML = '<input type="text" name="MVP' + matchRowCount + '" title="Man-of-the match">';
            cell3.innerHTML = '<input type="text" name="battingFirst' + matchRowCount + '" title="Team Batting First">';
            cell4.innerHTML = '<input type="text" name="bowlingFirst' + matchRowCount + '" title="Team Bowling First">';

            matchRowCount += 2;
        }
        else
            alert("Limit Reached");
    }

</script>

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
        Match ID: <input type="number" name="matchIDPerformance" title="Match ID" placeholder="Match ID"><br><br>
        Venue ID: <input type="number" name="venueID" title="Venue ID" placeholder="Venue ID"><br><br>
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
                <td><input type="number" name="matchID0" title="Match ID" required></td>
                <td><input type="text" name="MVP0" title="Man-of-the match"></td>
                <td><input type="text" name="battingFirst0" title="Team Batting First"></td>
                <td><input type="text" name="bowlingFirst0" title="Team Bowling First"></td>
            </tr>

        </table>
        <br><br>

        <input type="submit" name="submit">

    </form>
</div>

<button class="button" onclick="addMatchInfo()">Add Match</button><br><br><br>

</body>

</html>
