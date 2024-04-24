<?php

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}



require_once "../db_connection.php";

$user = $_SESSION["trainer"];
$sql = "SELECT * from courses WHERE `fk_user_id` = {$user} ";

$result = mysqli_query($connection, $sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$layout = "";

if (mysqli_num_rows($result) > 0) {
    foreach ($rows as $value) {
        $layout .= "<div>
        <div class='card my-3' style='width: 20 rem;'>
        <img src='{$value["picture"]}' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>{$value["subject"]}</h5>
        </div>
      </div>
    </div>";
    }
} else {
    $layout = "no courses found!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?= $row["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <a class="btn btn-primary" href="../User/indexUser.php" style="margin-left: 70px; margin-top: 50px;">Back</a>
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-xs-1" style="margin-left: 70px;">
        <?= $layout ?>
    </div>
</body>

</html>

<a href='crud/details.php?id={$value["id"]}' class='btn btn-success'>More Details</a>
<a href='adopte.php?id={$value["id"]}' class='btn btn-success'>Take Me Home</a>