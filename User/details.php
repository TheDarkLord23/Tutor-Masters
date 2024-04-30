<?php
session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

require "../db_connection.php";


if ($_GET["id"]) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM courses WHERE id = {$id}";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
    }
}
//     } else {
//         // header("location: error.php");
//     }
//     // mysqli_close($connection);
// } else {
//     // header("location: error.php");
// }


if (isset($_POST["bookings"])) {
    $user_id = $_SESSION["user"];
    $course_id = $_GET["id"];

    // Überprüfen, ob der Benutzer bereits für diesen Kurs angemeldet ist
    $checkBookingSql = "SELECT * FROM `bookings` WHERE `fk_user_id` = '{$user_id}' AND `fk_course_id` = '{$course_id}'";
    $checkBookingResult = mysqli_query($connection, $checkBookingSql);

    echo $countCapacity = "SELECT COUNT fk_course_id FROM bookings WHERE fk_course_id = '{$course_id}'";
    die();
    $checkCapacityResult= mysqli_query($connection, $countCapacity);
    

    if (mysqli_num_rows($checkBookingResult) > 0) {
        echo "You already subscribed to this course!";
    } else {
        // Wenn der Benutzer nicht angemeldet ist, die Buchung durchführen
        $booking_date = date("Y-m-d");
        $bookingSql = "INSERT INTO `bookings`(`fk_user_id`, `fk_course_id`, `date`) VALUES ('{$user_id}','{$course_id}',CURDATE())";

        if (mysqli_query($connection, $bookingSql)) {
            echo "Course has been booked. Gratulation!";
        } else {
            echo "Something went wrong. Please try again!";
        }
    }
}



$user_id = $_SESSION["user"];
foreach ($rows as $row) {
    $layout = '
    <div class="detailContainer">
        <div>
            <h1 class="">' . $row["subject"] . '</h1>
        </div>
        <div class="topCard">
            <p class="">University: ' . $row["university"] . '</p>
           
            <p class="">Availability: ' . $row["availability"] . '</p>
            <img src=../Images/' . $row["picture"] . ' class="" alt="...">
        </div>
    </div>'; 
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/details.css">
</head>

<body>
    <div>
        <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
        <div class="detail">
            <div>

                <?= $layout ?>

            </div>
        </div>
    </div>

</body>

</html>
