<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/indexUser.php");
}

require "../db_connection.php";
require "../login/file_upload.php";



// $booking_query = "SELECT * FROM `courses` WHERE `teacher` = {$_SESSION['trainer']}";
$booking_query = "SELECT * FROM courses WHERE fk_user_id = {$_SESSION['trainer']}";

$booking_result = mysqli_query($connection, $booking_query);
$booking_layout = mysqli_fetch_all($booking_result,MYSQLI_ASSOC);

$layout = "";

if (mysqli_num_rows($booking_result) == 0) {
    $layout = "You haven't booked any courses yet!";
} else {
    // while ($booking_row = mysqli_fetch_assoc($booking_result)) {
    //     $course_id = $booking_row['fk_course_id'];
    //     // Abfrage, um die Details des Kurses abzurufen
    //     $course_query = "SELECT * FROM courses WHERE id = $course_id";
    //     $course_result = mysqli_query($connection, $course_query);
    //     if ($course_result && mysqli_num_rows($course_result) == 1) {
    //         $course_row = mysqli_fetch_assoc($course_result);
            // Kursdetails anzeigen
            foreach ($booking_layout as $val) {
                $layout .= "<div class='center'>
                    <div class='card' style='width: 18rem;'>
                        <img src='../Imagess/{$val["picture"]}' class='card-img-top' alt='Course Image'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$val["subject"]}</h5>
                            <p class='card-text'>Date: {$val["date"]}</p>
                            <p class='card-text'>Duration: {$val["duration"]}</p>
                            <a href='details.php?id={$val["id"]}''>Details</a>
                            <a href='deleteCourses.php?id={$val["id"]}'>Delete</a>
                            <a href='updateCourses.php?id={$val["id"]}'>Update</a>
                        </div>
                    </div>
                </div>";
            }
        }
    // }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Trainer</title>
</head>

<body>
    <a href="createCourses.php">Create a new Course</a>
    <?= $layout ?>

</body>

</html>
