<?php
    include_once "connection.php";
?>


<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">

<head>
    <meta charset="UTF-8">
    <title>Team Search</title>
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li><a  href="playerRegistration.php">Registration</a></li>
    <li><a class="active" href="playerSearch.php">Information</a></li>
</ul>

<div class="playerProfile">
    <h1 class="pageName">Team Profile</h1>
</div>

<ul class="subMenu">
    <li><a href="playerSearch.php">Player Profile</a></li>
    <li><a href="clubSearch.php">Club Profile</a></li>
    <li><a class="active" href="teamSearch.php">Team Profile</a></li>
</ul>

<body>

<div class="forms">

    <?php
    // Players Table -----------------------------------------------------------------------------------------------

    $query = $_POST['teamSearch'];

    $query = htmlspecialchars($query);

    $teamInfo = "SELECT coach_name AS coach, formation_date AS dof
                FROM teams WHERE teamID = '$query'";

    $leaderName = "SELECT first_name AS firstName, last_name AS lastName
                FROM players WHERE playerID = (SELECT team_leaderID FROM teams WHERE teamID = '$query')";
                
    $clubName = "SELECT club_name AS clubName
                FROM clubs WHERE clubID = (SELECT clubID FROM teams WHERE teamID = '$query')";

    // Query to retrieve the list of players for the given teamID
    $playerListQuery = "SELECT player_name FROM team_playerlist WHERE teamID = '$query'";
    
    // Execute the player list query
    $playerListResult = mysqli_query($conn, $playerListQuery);
    
    // Fetch player list
    $playerList = array();
    while ($row = mysqli_fetch_assoc($playerListResult)) {
        $playerList[] = $row['player_name'];
    }

    $result1 = mysqli_query($conn, $teamInfo);
    $info1 = mysqli_fetch_assoc($result1);

    $result2 = mysqli_query($conn, $leaderName);
    $info2 = mysqli_fetch_assoc($result2);

    $result3 = mysqli_query($conn, $clubName);
    $info3 = mysqli_fetch_assoc($result3);

    if (!empty($info1['dof']))
    {
        $clubName = $info3['clubName'];
        $team_leader = $info2['firstName'];
        $team_leader .= " " . $info2['lastName'];
        $coach = $info1['coach'];
        $dof = $info1['dof'];


        echo "Club Name: $clubName <br><br>";
        echo "Team Leader: $team_leader <br><br>";
        echo "Coach: $coach <br><br>";
        echo "Date of Formation: $dof <br><br>";

        // Display player list
        echo "Player List:<br>";
        foreach ($playerList as $player) {
            echo "- $player<br>";
        }
    }

    else
        echo "Team Not Found";
    ?>

</div>

</body>

</html>