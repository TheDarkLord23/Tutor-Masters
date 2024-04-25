<?php
session_start();

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

require "../db_connection.php";


if($_GET["id"]) {
    $id = $_GET["id"];
    $sql= "SELECT * FROM courses WHERE id = {$id}";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);}}
//     } else {
//         // header("location: error.php");
//     }
//     // mysqli_close($connection);
// } else {
//     // header("location: error.php");
// }

// if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
//     header("Location: login.php");
// }

if (isset($_SESSION["user"])) {
    $sqlUser= "SELECT * FROM `users` WHERE id = {$_SESSION["user"]}";
    $runSqlUser = mysqli_query($connection, $sqlUser);
    $rowsUser = mysqli_fetch_assoc($runSqlUser);
// // adoption start
if (isset($_POST["bookings"])) {
    $user_id = $_SESSION["user"];
    $course_id = $_GET["id"];
    $booking_date = date("Y-m-d");
    $bookingSql = "INSERT INTO `bookings`(`fk_user_id`, `fk_course_id`) VALUES ('{$user_id}','{$course_id}')";
    if (mysqli_query($connection,$bookingSql)) {
        echo "Course has been booked. Gratulation!";
    } else {
        echo "Something went wrong.Please try again!";
    }
}
}
$user_id = $_SESSION["user"];
foreach($rows as $row) {

$layout = '<div class=" mb-5 col col-12 d-flex align-items-stretch">
<div class="row g-1 container-fluid card shadow-lg bg-card-color">
<img style="width:500px; height:600px; object-fit: cover; margin:auto" src=../img/'.$row["picture"].' class="card-img-top" alt="...">
<div class="card-body">
  <h5 class="card-title">'.$row["subject"].'</h5>
  <hr>
  <p class="card-text">Teacher: '.$row["teacher"].'</p>
  <p class="card-text">Date: '.$row["date"].'</p>
  <p class="card-text">Language: '.$row["language"].'</p>
  <p class="card-text">RoomNumb: '.$row["roomNumb"].'</p>
  <p class="card-text">Units: '.$row["units"].'</p>
  <p class="card-text">University: '.$row["university"].'</p>
  <p class="card-text">Availability: '.$row["availability"].'</p>
  <div class="btnAlign">
  <form method="post">
  <input class="btn btn-success" type="submit" name="bookings" value="book course">
  </form>
  <a class="btn btn-warning" href="review.php?course_id='.$row["id"].'&user_id='.$user_id.'">rate this course</a>
  <a class="btn btn-danger" href="indexUser.php">back to home</a></div>
</div>
</div>
</div>
';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
       .detailsProp{
        justify-content: center;
        align-items: center;
        text-align: center;
        border: black solid 2px;
       }
       .textRow{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
       }
       .card-text, .card-title{
        text-align: center;
       }
       .btnAlign{
        display: flex;
        justify-content: space-around;
       }
    </style>
    

</head>

<body>
    <br><br>
    <div class="container" >

        <?= $layout ?>

    </div>
  
</body>

</html>