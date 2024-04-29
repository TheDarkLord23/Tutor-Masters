<?php

session_start();

// Validation start:

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
  }
  
  if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/dashboardTrainer.php");
  }

// Validation end

// Connection start:

require_once "../db_connection.php";
require_once "../functions.php";

// Connection end


$layout = "";


$sql = "SELECT * FROM `courses`";
$runSql = mysqli_query($connection, $sql);



if (mysqli_num_rows($runSql) == 0) {
    $layout = "No results";
} else {
    $rows = mysqli_fetch_all($runSql, MYSQLI_ASSOC);
    foreach ($rows as $val) {
        $date =  strtotime($val["date"]);
        $date = date("j F Y", $date);
        $layout .=
            "
        <div class='course'>
        <div class='course-left'>
            <div class='card-holder'>
                <img class='card-img' src='/Images/{$val["picture"]}' alt='Image description' />
                <h4 class='card-title'>More Information</h4>
                <a href='detailsCourses.php?id={$val["id"]}' class='card-btn'>Details</a>
            </div>
            </div>
            <div class='info'>
                <h4 class='course-title'>{$val["subject"]}(m/w/d)</h4>
                <p class='course-date'>{$date} Duration: {$val["duration"]}mins.</p>
                <p class='course description'>
                    The media group around the oe24 network is one of the young and
                    dynamic players on the domestic market. With a newly established
                    internal structure, flat hierarchies and a young management team.
                </p>
            </div>
        </div>
        <div class='d-flex justify-content-between'>
            <div class='w-25'>
                <button class='submitBtn' style='width: 150px;'><a href='detailsCourses.php?id={$val["id"]}' style='text-decoration: none; color: #fff;'>Details</a></button>
                <button class='submitBtn' style='width: 150px;'><a href='updateCourses.php?id={$val["id"]}' style='text-decoration: none; color: #fff;'>Update</a></button>
            </div>
            <button class='submitBtn' style='width: 150px; background-color: #F77D48;'><a href='deleteCourses.php?id={$val["id"]}' style='text-decoration: none; color: #fff;'>Delete</a></button>
        </div>
        <div class='splitter'></div>
        
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/CRUD.css">
</head>

<body>
    <div class="containerCrud container mt-5">
        <div class="crudHeader">
            <h3>Courses</h3>
        </div>
        <div class="courses">
            <button class="submitBtn" style="width: 200px; background-color: #B6F6E3;"><a href='createCourses.php' style='text-decoration: none; color: #000; font-weight: 500; padding: 10px;'>Create new Courses</a></button>
            <div class="listCourses">
                <?= $layout ?>
            </div>
        </div>
    </div>

</body>

</html>