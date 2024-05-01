<?php

session_start();


if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
  header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
  header("Location: ../User/dashboardUser.php");
}
require_once "../db_connection.php";


$id = $_GET["id"];

$selectID = "SELECT * FROM `users` WHERE id = '{$id}'";

$result = mysqli_query($connection, $selectID);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/detailsUser.css">
</head>

<body>
  <div>
    <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
    <div class="infoCard">
      <div class="nameCard">
        <p><?= $row["firstName"] . ' ' . $row["secondName"] ?></p>
      </div>
      <div class="imgCard">
        <img src=../Images/<?= $row["picture"] ?> alt='image'>
      </div>
      <div class="infoBox d-flex justify-content-between">
        <div>
          <p>Adress:</p>
          <hr>
          <p>Email:</p>
          <hr>
          <p>Phone:</p>
          <hr>
          <p>Status:</p>
          <hr>
        </div>
        <div>
          <p><?= $row["address"] ?></p>
          <hr>
          <p><?= $row["email"] ?></p>
          <hr>
          <p><?= $row["phoneNumber"] ?></p>
          <hr>
          <p><?= $row["Status"] ?></p>
          <hr>
        </div>
      </div>
    </div>
</body>

</html>