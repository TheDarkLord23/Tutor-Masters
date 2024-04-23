<?php 

session_start();

// Validation start:

if (!isset($_SESSION["admin"])) {
    header("Location: ../login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/indexUser.php");
}

if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/indexTrainer.php");
}

// Validation end

// Connection start:

require_once "../db_connection.php";
require_once "../functions.php";

// Connection end


$layout = "";


$sql = "SELECT * FROM `courses`";
$runSql = mysqli_query($connection, $sql);



if (mysqli_num_rows($runSql)==0) {
    $laylout= "No results";
} else {
    $rows = mysqli_fetch_all($runSql, MYSQLI_ASSOC);
    foreach ($rows as $val) {
        $layout .=
        "
            <img src='../Images/{$val["picture"]}' alt='' class='imgCarts'/>
            <p>{$val["name"]}</p>
            <p>{$val["subject"]}</p>
            <a href='deleteCourses.php?id={$val["id"]}'>Delete</a>
            <a href='updateCourses.php?id={$val["id"]}'>Update</a>
            
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
</head>
<body>

<a href='createCourses.php'>Create new Courses</a>

<?=$layout?>  


</body>
</html>