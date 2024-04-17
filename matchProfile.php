<?php
    include_once "connection.php";
?>


<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">

<head>
    <meta charset="UTF-8">
    <title>Match Search</title>
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li><a  href="playerRegistration.php">Registration</a></li>
    <li><a class="active" href="playerSearch.php">Information</a></li>
</ul>

<div class="matchPage">
    <h1 class="pageName">Match Profile</h1>
</div>

<ul class="subMenu">
    <li><a href="playerSearch.php">Player Profile</a></li>
    <li><a href="clubSearch.php">Club Profile</a></li>
    <li><a href="teamSearch.php">Team Profile</a></li>
    <li><a class="active" href="teamSearch.php">Match Profile</a></li>
</ul>

<body>

<div class="forms">

    <?php
        // Players Table -----------------------------------------------------------------------------------------------

        $query = $_POST['matchSearch'];

        $query = htmlspecialchars($query);

        $matchInfo = "SELECT venue AS venue, team_batting_first AS batting_team, team_bowling_first AS bowling_team, date_of_match as dom, man_of_the_match as mvp
                    FROM matches WHERE matchID = '$query'";

        $event = "SELECT eventName AS eventName
                FROM events_organised WHERE eventID = (SELECT eventID FROM matches WHERE matchID = '$query')";

        
        $resultMatchInfo = mysqli_query($conn, $matchInfo);
        $matchData = mysqli_fetch_assoc($resultMatchInfo);

        // Execute event query
        $resultEvent = mysqli_query($conn, $event);
        $eventData = mysqli_fetch_assoc($resultEvent);

        // Display match information
        if ($matchData) {
            echo "<br>";
            echo "Event Name: " . $eventData['eventName'] . "<br><br>";
            echo "Venue: " . $matchData['venue'] . "<br><br>";
            echo "First Batting Team: " . $matchData['batting_team'] . "<br><br>";
            echo "First Bowling Team: " . $matchData['bowling_team'] . "<br><br>";
            echo "Date of Match: " . $matchData['dom'] . "<br><br>";
            echo "Man of the Match: " . $matchData['mvp'] . "<br><br><br>";
        } else {
            echo "Match Not Found";
        }
    ?>

</div>

</body>

</html>