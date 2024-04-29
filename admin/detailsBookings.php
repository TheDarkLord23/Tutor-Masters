<?php

session_start();

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION
["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
  }
  
  if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/dashboardTrainer.php");
  }
  

require_once "../db_connection.php";

$id = $_GET["id"];

if (isset($_SESSION["admin"])) {
    $sqlUser= "SELECT courses.subject,courses.university,courses.roomNumb,courses.language,courses.units,courses.picture,courses.duration,courses.availability,courses.name,courses.teacher,courses.date, users.firstName,users.secondName,users.email, bookings.booking_id FROM users JOIN bookings ON bookings.fk_user_id = users.id JOIN courses ON bookings.fk_course_id = courses.id WHERE booking_id = $id";
    $runSqlUser = mysqli_query($connection, $sqlUser);
    // $rowsUser = mysqli_fetch_assoc($runSqlUser);

    $layout = "";

    if (mysqli_num_rows($runSqlUser) == 0) {
        $layout = "There are no Course Bookings yet!";
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
                            <p>Student First Name: {$val["firstName"]}</p>
                            <p>Student Second Name: {$val["secondName"]}</p>
                            <p>Student email: {$val["email"]}</p>

                            <a href='deleteBookings.php?id={$val["booking_id"]}'>Delete</a>

                            <form method='post'>
                                <input  type='submit' name='bookings' value='book course'>
                            </form>
                    ";
            }
    
    }


if (isset($_POST["bookings"])) {
    $user_id = $_SESSION["admin"];
    $course_id = $_GET["id"];
    $bookingSql = "INSERT INTO `bookings`(`fk_user_id`, `fk_course_id`) VALUES ('{$user_id}','{$course_id}')";
    if (mysqli_query($connection,$bookingSql)) {
        echo "Course has been booked. Gratulation!";
    } else {
        echo "Something went wrong.Please try again!";
    }
}
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
    <?= $layout ?>
</body>
</html>