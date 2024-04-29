<?php

require "../db_connection.php";
require "../login/file_upload.php";

session_start();

// validation start:

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION
["user"])) {
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
    <style>.container {
            max-width: 600px;
            margin: auto;
            padding-top: 50px;
        }

        form {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="4"><path fill="%23666" d="M2 0l6 4 6-4"/></svg>') no-repeat right 10px center/8px 4px;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }
        #date{
            width: 100%; 
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px; box-sizing: border-box;
        }</style>
    <title>Document</title>
</head>
<body>

<h5>Update a User:</h5>
    <form action="" method="post" enctype="multipart/form-data">

    <label for="rating">rating</label>
    <select id="rating" name="rating">
                <option value="1">★☆☆☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="3">★★★☆☆</option>
                <option value="4">★★★★☆</option>
                <option value="5">★★★★★</option>
            </select>

    <label for="secondName">comment</label> 

    <input type="text" name="comment" value="update your comment">
    <input type="submit" name="submit" value="submit">
    </form>


</body>
</html>