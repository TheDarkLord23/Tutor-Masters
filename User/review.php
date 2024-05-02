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
            header("refresh: 2; url=dashboardUser.php");
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
    <title>Create new User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/CRUD.css">
</head>

<body>
<div class="containerCRUD container mt-5">
        <div class="crudHeader">
            <h3 class="mb-4">Update a Review:</h3>
        </div>
        <?php if (!empty($message)) : ?>
           <!-- ' updateError & massage noch bearbeiten' -->
            <div class="alert alert-<?= $class; ?>" role="alert">
                <p><?= $message ?></p>
                <a href='indexUser.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        <?php endif; ?>
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
            </select>     <button type="submit" class="submitBtn" style="width: 100%;" name="submit">Submit</button>
        </form>
   
    </div>
</body>

</html>