<?php
/**
 * Created by PhpStorm.
 * User: BLANK
 * Date: 08-Sep-18
 * Time: 2:42 PM
 */
?>

<html>

<link rel="stylesheet" type="text/css" href="CCBStyleSheet.css">

<head>
    <meta charset="UTF-8">
    <title>Club Search</title>
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li><a  href="playerRegistration.php">Registration</a></li>
    <li><a class="active" href="playerSearch.php">Information</a></li>
</ul>

<div class="clubPage">
    <h1 class="pageName">Club Profile</h1>
</div>

<ul class="subMenu">
    <li><a href="playerSearch.php">Player Profile</a></li>
    <li><a class="active" href="clubSearch.php">Club Profile</a></li>
    <li><a href="teamSearch.php">Team Profile</a></li>
    <li><a href="matchSearch.php">Match Profile</a></li>
</ul>

<body>

<div class="forms">
    <form class="forms" action="clubProfile.php" method="post">

        <h4 class="headers">Search using Club ID </h4>

        <input type="search" name="clubSearch" title="Search using club ID" placeholder="Search..." required><br><br>

        <input type="submit" name="Search">

    </form>
</div>

</body>

</html>