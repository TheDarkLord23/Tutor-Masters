<?php 

session_start();

// Validation start:

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION
["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/indexUser.php");
}

if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/indexTrainer.php");
}

// Validation end


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<a href='retrieveCourses.php'>View all Courses</a>
<a href="retrieveUser.php">View all User</a>
<a href="retrieveBookings.php">View all Bookings</a>
 


</body>
</html>