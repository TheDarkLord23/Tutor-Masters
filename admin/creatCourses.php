<?php
require "../db_connection.php";
require "../login/file_upload.php";

session_start();

// validation start:

    if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
        header("Location: ../login.php");
    }

    if (isset($_SESSION["user"])) {
        header("Location: ../home.php");
    }

// validation end

// Create start:

if (isset($_POST["submit"])) {
    $subject = $_POST["subject"];
    $university = $_POST["university"];
    $roomNumb = $_POST["roomNumb"];
    $date = $_POST["date"];
    $teacher = $_POST["teacher"];
    $language = $_POST["language"];
    $availability = $_POST["availability"];
    $units = $_POST["units"];
    $duration = $_POST["duration"];
    $picture = fileUpload($_FILES["picture"]);

    $sql = "INSERT INTO `courses`(`subject`, `university`, `roomNumb`, `date`, `teacher`, `picture`, `language`, `duration`, `units`, `availability`) VALUES ('{$subject}','{$university}','{$roomNumb}','{$date}','{$teacher}','{$picture[0]}','{$language}','{$duration}','{$units}','{$availability}')";

    if (mysqli_query($connection, $sql)) {
        echo "<div class='containerAlert'><p>New Course has been created. $picture[1]</p></div>";
        header("refresh: 3; url=indexAdmin.php");
    } else {
        echo "<div class='containerAlert2'><p>Something went wrong.Please try again later!</p></div>";
    }
}

// Create en

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="container">
    <h5>Create a Course:</h5>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="inputFields">
            <input type="text" placeholder="Subject" name="subject" required>
        </div>
        <div class="inputFields">
            <input type="text" placeholder="university" name="university">
        </div>
        <div class="inputFields">
            <input type="text" placeholder="Room Number" name="roomNumb" required>
        </div>
        <div class="inputFields">
            <input type="date" placeholder="Date" name="date" required>
        </div>
        <div class="inputFields">
            <input type="text" placeholder="Teacher" name="teacher" required>
        </div>
        <div class="inputFields">
            <input type="text" placeholder="Language" name="language" required>
        </div>
        <div class="inputFields">
            <input type="text" placeholder="Availability" name="availability" required>
        </div>
        <div class="inputFields">
            <input type="text" placeholder="Number of Units" name="units" required>
        </div>
        <div class="inputFields">
            <input type="text" placeholder="Duration" name="duration" required>
        </div>
        <div class="imgInput inputFields">
            <input type="file" name="picture">
        </div>
        <div class="submitInput">
            <input class="submitBtn" type="submit" name="submit">
        </div>
    </form>
</div>
</body>
</html>