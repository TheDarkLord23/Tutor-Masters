<?php

require "../db_connection.php";
require "../login/file_upload.php";

session_start();

// validation start:

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: ../User/indexAdmin.php");
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
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];


    $sql = "UPDATE `review` SET `rating`='{$rating}',`comment`='{$comment}' WHERE id = $id";


    if (mysqli_query($connection, $sql)) {
        echo "<p>Review has been updated!</p>";
        header("refresh: 3; url=dashboardUser.php");
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
    <title>Create new User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/CRUD.css">
</head>

<body>
    <div class="containerCRUD container mt-5">
        <div class="crudHeader">
            <h3 class="mb-4">Update a Review:</h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="lNameInput inputFields">
                <label style="margin: 0;" for="secondName">Comment</label>
                <input class="input" type="text" name="comment" value="update your comment">
            </div>
            <label style="margin: 0;" for="rating">Rating</label>
            <select class="input" id="rating" name="rating">
                <option value="1">★☆☆☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="3">★★★☆☆</option>
                <option value="4">★★★★☆</option>
                <option value="5">★★★★★</option>
            </select> 
               <button type="submit" class="submitBtn" style="width: 100%;" name="submit">Submit</button>
        </form>
    
    </div>
</body>

</html>