<?php



session_start();

require_once "../db_connection.php";


$session = 0;
$goBack = "";

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION["user"])) {
    
    $goBack = "index.php";
} else {
    $session = $_SESSION["user"];
    // $goBack = "indexUser.php";
}

// $sql = "SELECT * FROM users WHERE id = {$session}";
// $result = mysqli_query($connection, $sql);
// $row = mysqli_fetch_assoc($result);


if (isset($_POST["submit"])) {
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
   
    $fk_user_id = $_GET["user_id"];
    $fk_course_id = $_GET["course_id"];
 

  
        $sqlInsert = "INSERT INTO `review`(`rating`, `comment`,`date`, `fk_course_id`, `fk_user_id`) VALUES ('{$rating}','{$comment}',  CURRENT_DATE(),'{$fk_course_id}','{$fk_user_id }')";

        $result = mysqli_query($connection, $sqlInsert);



        if ($result) {
            echo "Your review ha been posted!";
            $rating = $comment = "";
            header("refresh: 3; url=mycourses.php");
        }else {
            echo "Error";
        }

  

    // header("Location: {$goBack}");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rate your course</title>
    <style> .container {
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
        }
        
        </style>
</head>

<body>
<div class="container">
        <h2>Create review</h2>
        <?php if (!empty($message)) : ?>
           <!-- ' updateError & massage noch bearbeiten' -->
            <div class="alert alert-<?= $class; ?>" role="alert">
                <p><?= $message ?></p>
                <a href='indexUser.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
    <label for="rating">rating</label>
    <select id="rating" name="rating">
                <option value="1">★☆☆☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="3">★★★☆☆</option>
                <option value="4">★★★★☆</option>
                <option value="5">★★★★★</option>
            </select>
    <label for="secondName">comment</label> 
    <input type="text" name="comment" placeholder="how did you like this course?">
    <input type="submit" name="submit" value="submit">
</form>
</body>

</html>