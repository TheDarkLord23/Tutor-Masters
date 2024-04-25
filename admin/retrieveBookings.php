<?php 

session_start();


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

require_once "../db_connection.php";


$user_id = $_SESSION['admin'];


$booking_query = "SELECT courses.subject,courses.teacher,courses.date , users.firstName,users.secondName,bookings.booking_id FROM users JOIN bookings ON bookings.fk_user_id = users.id JOIN courses ON bookings.fk_course_id = courses.id;";

$booking_result = mysqli_query($connection, $booking_query);





$layout = "";

if (mysqli_num_rows($booking_result) == 0) {
    $layout = "There are no Course Bookings yet!";
} else {
        // Abfrage, um die Details des Kurses abzurufen
        $row = mysqli_fetch_all($booking_result, MYSQLI_ASSOC); 
        foreach ($row as $val) {
            // Kursdetails anzeigen
            $layout .= "
                        <p>Subject: {$val["subject"]}</p>
                        <p>Teacher: {$val["teacher"]}</p>
                        <p>Date: {$val["date"]}</p>

                        <a href='detailsBookings.php?id={$val["booking_id"]}'>Details</a>
                        <a href='deleteBookings.php?id={$val["booking_id"]}'>Delete</a>
                ";
        }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booked Courses</title>
</head>

<body>

        <h2 class="text-center">All Bookings:</h2>
            <?= $layout ?>

</body>

</html>
