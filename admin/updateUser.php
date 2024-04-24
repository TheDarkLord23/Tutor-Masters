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
$sql = "SELECT * FROM `users` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

// Get Data from table end

// update start:

if (isset($_POST["submit"])) {
    $firstName = $_POST["firstName"];
    $secondName = $_POST["secondName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phoneNumber"];
    $status = $_POST["status"];
    $picture = fileUpload($_FILES["picture"]);

    $sql = "UPDATE `users` SET `firstName`='{$firstName}',`secondName`='{$secondName}',`email`='{$email}',`address`='{$address}',`phoneNumber`='{$phoneNumber}',`Status`='{$status}',`picture`='{$picture[0]}' WHERE id = $id";


    if (mysqli_query($connection, $sql)) {
        echo "<p>User has been updated!</p>";
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

<h5>Update a User:</h5>
    <form action="" method="post" enctype="multipart/form-data">

            <input type="text" value="<?=$row["firstName"]?>" name="firstName" required>

            <input type="text" value="<?=$row["secondName"]?>" name="secondName">

            <input type="text" value="<?=$row["email"]?>" name="email" required>

            <input type="text" value="<?=$row["address"]?>" name="address" required>

            <input type="text" value="<?=$row["phoneNumber"]?>" name="phoneNumber" required>
            
            <label for="status">Status:</label>
                <select name="status" required>
                    <option value="user" <?= $row["Status"] == "user" ? 'selected' : '' ?>>user</option>
                    <option value="admin" <?= $row["Status"] == "admin" ? 'selected' : '' ?>>admin</option>
                    <option value="trainer" <?= $row["Status"] == "trainer" ? 'selected' : '' ?>>trainer</option>
                 </select>

            <input type="file" name="picture">

            <input type="submit" name="submit">
    </form>


</body>
</html>