<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: ../Admin/dashboardAdmin.php");
}


require_once "../db_connection.php";

// Show all the students that are taking this course==================

$id = $_SESSION['user_id'];

// $sqlGetUsers = "SELECT * FROM `users`
//                  WHERE `id` in (SELECT fk_user_id from bookings where fk_course_id = $id)";
$sqlGetUsers = "SELECT users.firstName, users.secondName, users.email, bookings.id
                    FROM `users`
                    JOIN `bookings` ON users.id = bookings.fk_user_id 
                    WHERE bookings.fk_course_id = $id";



$res = mysqli_query($connection, $sqlGetUsers);

$layout1 = "";

if (mysqli_num_rows($res) == 0) {
    $layout1 = "There are no Course yet!";
} else {
    // Abfrage, um die Details des Kurses abzurufen
    $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    foreach ($data as $val) {
        // Kursdetails anzeigen
        $layout1 .= "
                <p>Student First Name: {$val["firstName"]}</p>
                <p>Student Second Name: {$val["secondName"]}</p>
                <p>Student email: {$val["email"]}</p>
                <a href='removeStudent.php?studentId={$val["booking_id"]}'>Remove student</a>
                    ";
    }
}


//=============================================

// Select the details from the course=============

$sqlUser = "SELECT * FROM `courses` WHERE `id` = $id";
$runSqlUser = mysqli_query($connection, $sqlUser);

$layout = "";

if (mysqli_num_rows($runSqlUser) == 0) {
    $layout = "There are no Course yet!";
} else {
    // Abfrage, um die Details des Kurses abzurufen
    $row = mysqli_fetch_all($runSqlUser, MYSQLI_ASSOC);
    foreach ($row as $val) {
        // Kursdetails anzeigen
        $layout .= "

                <img scr='../Images/{$val["picture"]}' alt='image'>
                <p>Subject: {$val["subject"]}</p>
                <p>University: {$val["university"]}</p>
                <p>RoomNumb: {$val["roomNumb"]}</p>
                <p>Language: {$val["language"]}</p>
                <p>Units: {$val["units"]}</p>
                <p>Duration: {$val["duration"]}</p>
                <p>Availability: {$val["availability"]}</p>
                <p>Name: {$val["name"]}</p>
                <p>Teacher: {$val["teacher"]}</p>
                <p>Date: {$val["date"]}</p>
                    ";
    }
}

// ====================================================

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Course:</h1>
    <?= $layout ?>
    <br>
    <br>
    <h1>All the students, that takes this course:</h1>
    <?= $layout1 ?>
</body>

</html>