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

    $sqlUser= "SELECT courses.*, users.firstName,users.secondName,users.email, bookings.id as booking_id FROM users JOIN bookings ON bookings.fk_user_id = users.id JOIN courses ON bookings.fk_course_id = courses.id WHERE courses.id = $id";
   
    $runSqlUser = mysqli_query($connection, $sqlUser);
    // $rowsUser = mysqli_fetch_assoc($runSqlUser);

    $layout = "";

    
$usersDetails = "";
    if (mysqli_num_rows($runSqlUser) == 0) {
        $layout = "There are no Course Bookings yet!";
        
    } else {
            // Abfrage, um die Details des Kurses abzurufen
            $row = mysqli_fetch_all($runSqlUser, MYSQLI_ASSOC); 
          
            foreach ($row as $val) {
                
                // Kursdetails anzeigen
                $usersDetails .= "<p>Student First Name: {$val["firstName"]}</p>
                <p>Student Second Name: {$val["secondName"]}</p>
                <p>Student email: {$val["email"]}</p>";
            }
            $layout .= "
            <img scr='../Images/{$row[0]["picture"]}' alt='image'>
            <p>Subject: {$row[0]["subject"]}</p>
            <p>University: {$row[0]["university"]}</p>
            <p>RoomNumb: {$row[0]["roomNumb"]}</p>
            <p>Language: {$row[0]["language"]}</p>
            <p>Units: {$row[0]["units"]}</p>
            <p>Duration: {$row[0]["duration"]}</p>
            <p>Availability: {$row[0]["availability"]}</p>
            <p>Name: {$row[0]["name"]}</p>
            <p>Teacher: {$row[0]["teacher"]}</p>
            <p>Date: {$row[0]["date"]}</p>
            $usersDetails

            <a href='deleteBookings.php?id={$row[0]["booking_id"]}'>Delete</a>
    ";
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