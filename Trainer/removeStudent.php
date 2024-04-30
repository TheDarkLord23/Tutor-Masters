<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

require_once "../db_connection.php";

$id= $_GET["courseId"];
$userId= $_GET["userid"];

$sql = "SELECT * FROM `bookings` WHERE fk_user_id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
// if ($row["picture"] != "defaultPic.jpg" or ) {
//     unlink("../Images/{$row["picture"]}");
// }



$delete = "DELETE FROM bookings WHERE bookings.fk_course_id = $id AND bookings.fk_user_id = $userId";


if(mysqli_query($connection, $delete)){
    echo "Your booking has been removed";
    header("url=details.php");
}else {
    echo "Error";
}

mysqli_close($connection);


if ($result) {
    echo "Your review ha been posted!";
    $rating = $comment = "";
    header("refresh: 3; url=mycourses.php?id=$userId");
}else {
    echo "Error";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
</body>
</html>