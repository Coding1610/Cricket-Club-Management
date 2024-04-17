<?php
    include_once "connection.php";
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
    <h1 class="pageName">Player Profile</h1>
</div>

<ul class="subMenu">
    <li><a href="playerSearch.php">Player Profile</a></li>
    <li><a class="active" href="clubSearch.php">Club Profile</a></li>
</ul>

<body>

<div class="forms">

    <?php
    // clubs Table -----------------------------------------------------------------------------------------------

    $query = $_POST['clubSearch'];

    $query = htmlspecialchars($query);

    $clubInfo = "SELECT club_name AS Club_Name, president AS President, date_established AS Date_of_Establishment
                    FROM clubs WHERE clubID = '$query'";

    $result = mysqli_query($conn, $clubInfo);

    $info = mysqli_fetch_assoc($result);

    if (!empty($info['Club_Name']))
    {
        $clubName = $info['Club_Name'];
        $president = $info['President'];
        $doe = $info['Date_of_Establishment'];


        echo "Club Name: $clubName <br><br>";
        echo "President Name: $president <br><br>";
        echo "Date of Establishment: $doe <br><br>";
    }

    else
        echo "Club Not Found";
    ?>

</div>

</body>

</html>