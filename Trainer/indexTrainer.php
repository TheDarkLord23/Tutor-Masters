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
        $layout .= "
        <p>course type : {$value["subject"]}</p>
        <img src='{$value["picture"]}' width='50'> ";
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
    <title>Document</title>
</head>

<body>
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-xs-1" style="margin-left: 70px;">
        <?= $layout ?>
    </div>
</body>

</html>