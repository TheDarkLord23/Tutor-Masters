<?php

require "../db_connection.php";
require "../login/file_upload.php";

session_start();

// validation start:

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

// validation end

// Get Data from table start:


$id = $_GET["id"];
$sql = "SELECT * FROM `courses` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

// Get Data from table end

// update start:

if (isset($_POST["submit"])) {
    $subject = $_POST["subject"];
    $name = $_POST["name"];
    $university = $_POST["university"];
    $roomNumb = $_POST["roomNumb"];
    $date = $_POST["date"];
    $teacher = $_POST["teacher"];
    $language = $_POST["language"];
    $availability = $_POST["availability"];
    $units = $_POST["units"];
    $duration = $_POST["duration"];
    $picture = fileUpload($_FILES["picture"]);

    $sql = "UPDATE `courses` SET `subject`='{$subject}',`university`='{$university}',`roomNumb`='{$roomNumb}',`date`='{$date}',`teacher`='{$date}',`picture`='{$picture[0]}',`language`='{$language}',`duration`='{$duration}',`units`='{$units}',`availability`='{$availability}',`name`='{$name}' WHERE id = $id";


    if (mysqli_query($connection, $sql)) {
        echo "<p>Course has been updated!</p>";
        header("refresh: 3; url=indexAdmin.php");
    } else {
        echo "<p>Something went wrong.Please try again later!</p>";
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
</head>
<body>


    <h5>Update a course:</h5>
    <form action="" method="post" enctype="multipart/form-data">

            <input type="text" value="<?=$row["subject"]?>" name="subject" required>

            <input type="text" value="<?=$row["name"]?>" name="name">

            <input type="text" value="<?=$row["university"]?>" name="university" required>

            <input type="text" value="<?=$row["roomNumb"]?>" name="roomNumb" required>

            <input type="datetime-local" value="<?=$row["date"]?>" name="date" required>

            <input type="text" value="<?=$row["teacher"]?>"" name="teacher" required>

            <input type="text" value="<?=$row["language"]?>" name="language" required>

            <input type="text" value="<?=$row["availability"]?>" name="availability" required>

            <input type="text" value="<?=$row["units"]?>" name="units" required>

            <input type="text" value="<?=$row["duration"]?>" name="duration" required>

            <input type="file" name="picture">

            <input type="submit" name="submit">
    </form>

</body>
</html>
