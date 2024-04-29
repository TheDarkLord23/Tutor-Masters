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


$sql = "SELECT * FROM `users`";
$runSql = mysqli_query($connection, $sql);



if (mysqli_num_rows($runSql) == 0) {
    $laylout = "No results";
} else {
    $rows = mysqli_fetch_all($runSql, MYSQLI_ASSOC);
    foreach ($rows as $val) {
        $layout .=
            "
        <div class='user'>
            <div class='course-left'>
                <div class='card-holder'>
                    <img class='card-img' src='/Images/{$val["picture"]}' alt='Image description' />
                </div>
            </div>
        <div>
            <div class='info'>
                <h4 class='course-title d-inline'>{$val["firstName"]}</h4>
                <h4 class='course-title d-inline'>{$val["secondName"]}</h4>
            </div>
            <div>
                
            </div>
        </div>

        </div>
        <div class='d-flex justify-content-between'>
            <div class='w-25'>
                <button class='submitBtn' style='width: 150px;'><a href='detailsUsers.php?id={$val["id"]}' style='text-decoration: none; color: #fff;'>Details</a></button>
                <button class='submitBtn' style='width: 150px;'><a href='updateUser.php?id={$val["id"]}' style='text-decoration: none; color: #fff;'>Update</a></button>
            </div>
            <button class='submitBtn' style='width: 150px; background-color: #F77D48;'><a href='deleteUser.php?id={$val["id"]}' style='text-decoration: none; color: #fff;'>Delete</a></button>
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
            <h3>Users</h3>
        </div>
        <div class="users">
            <button class="submitBtn" style="width: 200px; background-color: #B6F6E3;"><a href='createCourses.php' style='text-decoration: none; color: #000; font-weight: 500; padding: 10px;'>Create new Courses</a></button>
            <div class="listUsers">
                <?= $layout ?>
            </div>
        </div>
    </div>

</body>

</html>