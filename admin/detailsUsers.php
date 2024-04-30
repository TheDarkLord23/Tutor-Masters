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

if ($_GET["id"]) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM `users` WHERE id = {$id}";
  $result = mysqli_query($connection, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (mysqli_num_rows($result) == 1) {
      $data = mysqli_fetch_assoc($result);
  }
}

$user_id = $_SESSION["admin"];
foreach ($rows as $row) {
    $layout = '
    <div class="detailContainer">
        <div>
            <h1 class="">' . $row["firstName"]. '</h1>
            <h1 class="">' . $row["secondName"]. '</h1>
        </div>
        <div class="topCard">
            <div class="leftCard">
                <ul style="">

                    <li>
                        <p>Email: <strong>' . $row["email"] . '</strong></p>
                    </li>
                   
                    <li>
                    <p>Address: <strong>' . $row["address"] . '</strong></p>
                </li>
                <li>
                <p>Phone Number: <strong>' . $row["phoneNumber"] . '</strong></p>
            </li>
                <li>
                <p>Status: <strong>' . $row["Status"] . '</strong></p>
            </li>
                </ul>
            </div>
            <img src=../Images/' . $row["picture"] . ' class="" alt="...">
        </div>
    <div class="detailsBtn">
        <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
            <a href="dashboardAdmin.php">back to home</a></div>
        </div>
    </div>
    </div>'; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/details.css">
</head>

<body>
  
<div>
        <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
        <div class="detail">
            <div>

                <?= $layout ?>

            </div>
        </div>
    </div>

        
</body>

</html>