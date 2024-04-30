<?php

session_start();


if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
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
    <div>
      <img class='imgCarts' src=../Images/<?= $row["picture"] ?> alt='image'>
      <p><?= $row["firstName"] ?></p>
      <p><?= $row["secondName"] ?></p>
      <p><?= $row["email"] ?></p>
      <p><?= $row["address"] ?></p>
      <p><?= $row["phoneNumber"] ?></p>
      <p><?= $row["Status"] ?></p>
    </div>
  </div>



</body>

</html>