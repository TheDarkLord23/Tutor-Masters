<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

require_once "../db_connection.php";

$id= $_GET["courseId"];

$sql = "SELECT * FROM `bookings` WHERE fk_user_id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
// if ($row["picture"] != "defaultPic.jpg" or ) {
//     unlink("../Images/{$row["picture"]}");
// }
$userId = $_SESSION['user_id'];


$delete = "DELETE FROM bookings WHERE users.email = 
                JOIN bookings ON users.id = bookings.fk_user_id
                JOIN courses ON bookings.fk_course_id = courses.id
                WHERE courses.id = $id";


if(mysqli_query($connection, $delete)){
    // header("Location: detailsCourses.php");
}else {
    echo "Error";
}

mysqli_close($connection);
echo "<?= $userId ?>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
</body>
</html>