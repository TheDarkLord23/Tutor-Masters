<?php

require "../db_connection.php";
require "../login/file_upload.php";

session_start();

// validation start:

    if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
        header("Location: ../login.php");
    }

    if (isset($_SESSION["user"])) {
        header("Location: ../User/indexUser.php");
    }

// validation end

// Get Data from table start:


$id = $_GET["id"];
$sql = "SELECT * FROM `animal` WHERE animal_id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);


$sqlUser= "SELECT * FROM `user` WHERE user_id = {$_SESSION["admin"]}";
$runSqlUser = mysqli_query($connection, $sqlUser);
$rowsUser = mysqli_fetch_assoc($runSqlUser);

// Get Data from table end

// update start:

if (isset($_POST["submit"])) {
    $animal_name = $_POST["animal_name"];
    $animal_description = $_POST["animal_description"];
    $animal_location = $_POST["animal_location"];
    $animal_size = $_POST["animal_size"];
    $animal_age = $_POST["animal_age"];
    $animal_vaccinated = $_POST["animal_vaccinated"];
    $animal_breed = $_POST["animal_breed"];
    $animal_status = $_POST["animal_status"];
    $animal_photo = fileUpload($_FILES["animal_photo"]);

    $sql = "UPDATE `animal` SET `animal_name`='{$animal_name}',`animal_photo`='{$animal_photo[0]}',`animal_location`='{$animal_location}',`animal_description`='{$animal_description}',`animal_size`='{$animal_size}',`animal_age`='{$animal_age}',`animal_vaccinated`='{$animal_vaccinated}',`animal_breed`='{$animal_breed}',`animal_status`='{$animal_status}' WHERE animal_id = $id";

    if (mysqli_query($connection, $sql)) {
        echo "<div class='containerAlert'><p>Animal has been updated!</p></div>";
        header("refresh: 3; url=dashboard.php");
    } else {
        echo "<div><p>Something went wrong.Please try again later!</p></div>";
    }
}

// update end
mysqli_close($connection);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Style/CRUD.css">
    <link rel="stylesheet" href="navbarDashboard.php">
    <link rel="stylesheet" href="/Style/navbarHome.css">
</head>
<body>

<div class="container">
    <h5>Please insert your data:</h5>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_name"]?>" name="animal_name" required>
        </div>
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_description"]?>" name="animal_description">
        </div>
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_location"]?>" name="animal_location" required>
        </div>
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_size"]?>" name="animal_size" required>
        </div>
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_age"]?>" name="animal_age" required>
        </div>
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_vaccinated"]?>"" name="animal_vaccinated" required>
        </div>
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_breed"]?>" name="animal_breed" required>
        </div>
        <div class="inputFields">
            <input type="text" value="<?=$row["animal_status"]?>" name="animal_status" required>
        </div>
        <div class="imgInput inputFields">
            <input type="file" name="animal_photo">
        </div>
        <div class="submitInput">
            <input class="submitBtn" type="submit" name="submit">
        </div>
    </form>
</div>
</body>
</html>