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

<div class="teamPage">
    <h1 class="pageName">Team Profile</h1>
</div>

<ul class="subMenu">
    <li><a href="playerSearch.php">Player Profile</a></li>
    <li><a href="clubSearch.php">Club Profile</a></li>
    <li><a class="active" href="teamSearch.php">Team Profile</a></li>
</ul>

<body>

<div class="forms">
    <form class="forms" action="teamProfile.php" method="post">

        <h4 class="headers">Search using Team ID </h4>

        <input type="search" name="teamSearch" title="Search using team ID" placeholder="Search..." required><br><br>

        <input type="submit" name="Search">

    </form>
</div>

</body>

</html>