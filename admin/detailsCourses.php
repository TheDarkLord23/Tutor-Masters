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


$id = $_GET["id"];

$selectID = "SELECT * FROM `courses` WHERE id = '{$id}'";

$result = mysqli_query($connection, $selectID);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img class='imgCarts' src=../Images/<?=$row["picture"]?> alt='image'>
        <p><?=$row["subject"]?></p>
        <p><?=$row["university"]?></p>
        <p><?=$row["roomNumb"]?></p>
        <p><?=$row["date"]?></p>
        <p><?=$row["teacher"]?></p>
        <p><?= $row["language"]?></p>
        <p><?= $row["duration"]?></p>
        <p><?= $row["units"]?></p>
        <p><?= $row["availability"]?></p>
        <p><?= $row["name"]?></p>
</body>
</html>