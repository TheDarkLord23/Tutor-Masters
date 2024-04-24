<?php 


//neu!!!!
session_start();

include_once '../db_connection.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: ../login/login.php");
    exit;
}

if (isset($_SESSION["user"])) {
    $sqlUser= "SELECT * FROM `users` WHERE id = {$_SESSION["user"]}";
    $runSqlUser = mysqli_query($connection, $sqlUser);
    $rowsUser = mysqli_fetch_assoc($runSqlUser);
// adoption start
if (isset($_POST["bookings"])) {
    $user_id = $_SESSION["user"];
    $course_id = $_POST["id"];
    $booking_date = date("Y-m-d");
    $bookingSql = "INSERT INTO `bookings`(`fk_user_id`, `fk_course_id`) VALUES ('{$user_id}','{$course_id}')";
    if (mysqli_query($connection,$adoptionSql)) {
        echo "Course has been booked. Gratulation!";
    } else {
        echo "Something went wrong.Please try again!";
    }
}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container text-center">
        <div class="row justify-content-evenly py-5">
            <div class="d-flex flex-column align-items-center mt-3 mb-3">
                <h1>Course bookings:</h1>
            </div>
            <div class="alert alert-<?=$class;?> d-flex flex-column align-items-center" role="alert">
                <?=$message;?>
                <h2><?=$body;?></h2>
                <a href='indexUser.php' class="btn btn-success form-control">Back</a>
            </div>
        </div>
    </div>
   </div>
</body>
</html>
