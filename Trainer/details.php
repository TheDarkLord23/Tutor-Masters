<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/indexUser.php");
}

require_once "../db_connection.php";

$id = $_GET["id"];

// if (isset($_SESSION["trainer"])) {
    $sqlUser= "SELECT courses.*, users.firstName,users.secondName,users.email FROM courses JOIN users ON courses.fk_user_id = users.id WHERE courses.id = $id";
    $runSqlUser = mysqli_query($connection, $sqlUser);
    // $rowsUser = mysqli_fetch_assoc($runSqlUser);

    $layout = "";

    if (mysqli_num_rows($runSqlUser) == 0) {
        $layout = "There are no Course yet!";
    } else {
            // Abfrage, um die Details des Kurses abzurufen
            $row = mysqli_fetch_all($runSqlUser, MYSQLI_ASSOC); 
            foreach ($row as $val) {
                // Kursdetails anzeigen
                $layout .= "
                            <img scr='../Images/{$val["picture"]}' alt='image'>
                            <p>Subject: {$val["subject"]}</p>
                            <p>University: {$val["university"]}</p>
                            <p>RoomNumb: {$val["roomNumb"]}</p>
                            <p>Language: {$val["language"]}</p>
                            <p>Units: {$val["units"]}</p>
                            <p>Duration: {$val["duration"]}</p>
                            <p>Availability: {$val["availability"]}</p>
                            <p>Name: {$val["name"]}</p>
                            <p>Teacher: {$val["teacher"]}</p>
                            <p>Date: {$val["date"]}</p>
                            <p>Student First Name: {$val["firstName"]}</p>
                            <p>Student Second Name: {$val["secondName"]}</p>
                            <p>Student email: {$val["email"]}</p>
                    ";
            }
    
    }

// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= $layout ?>
</body>
</html>