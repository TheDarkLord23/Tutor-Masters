<?php 

require_once "../db_connection.php";

session_start();

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION
["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: ../User/indexAdmin.php");
}

if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/indexTrainer.php");
}


$id = $_GET["id"];
$course_id = $_GET['CI'];



$sql = "SELECT * FROM `users` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);


$delete = "DELETE FROM `bookings` WHERE id = $id";

$countCapacity = "UPDATE `courses` SET `capacity`= capacity+1 WHERE id =  {$course_id}";
$checkCapacityResult= mysqli_query($connection, $countCapacity);

if(mysqli_query($connection, $delete)){
    header("Location: mycourses.php");
}else {
    echo "Error";
}

mysqli_close($connection);

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