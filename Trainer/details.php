<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: ../Admin/dashboardAdmin.php");
}


require_once "../db_connection.php";

// Show all the students that are taking this course==================

$id = $_SESSION['user_id'];
$sqlTrainerDetails = "SELECT * FROM users WHERE id = {$id}";
$result = mysqli_query($connection, $sqlTrainerDetails);
$row = mysqli_fetch_assoc($result);
$TrainerEmail = $row['email'];


// $sqlGetUsers = "SELECT * FROM `users`
//                  WHERE `id` in (SELECT fk_user_id from bookings where fk_course_id = $id)";
// $sqlGetUsers = "SELECT users.firstName, users.secondName, users.email, bookings.id
//                     FROM `users`
//                     JOIN `bookings` ON users.id = bookings.fk_user_id 
//                     WHERE bookings.fk_course_id = $id";
$courses = "";
$sqlGetCourses = "SELECT * FROM `courses` WHERE email = '{$TrainerEmail}'";
$courses_result = mysqli_query($connection,$sqlGetCourses);
if(mysqli_num_rows($courses_result) > 0){
    $rows = mysqli_fetch_all($courses_result,MYSQLI_ASSOC);
    foreach ($rows as  $value) {
        $courses .= '
        <div class="detailContainer">
            <div>
                <h1 class="">' . $value["subject"] . '</h1>
            </div>
            <div class="topCard">
                <div class="leftCard">
                    <ul style="">
                        <li>
                            <a href="teacherDetail.php?email=' . $value["email"] . '">Teacher: <strong>' . $value["teacher"] . '</strong></a>
                        </li>
                        <li>
                            <p>University: <strong>' . $value["university"] . '</strong></p>
                        </li>
                       
                        <li>
                        <p>Capacity left: <strong>' . $value["capacity"] . '</strong></p>
                    </li>
                    <li>
                    <p>Availability: <strong>' . $value["availability"] . '</strong></p>
                </li>
                    </ul>
                </div>
                <img src=../Images/' . $value["picture"] . ' class="" alt="...">
            </div>
            <div class="d-flex justify-content-between infoBox">
                <div class="d-flex infoContainer">
                    <div class="imgCard">
                        <img src="../Images/flag.png" alt="">
                    </div>
                    <div>
                        <p>RoomNumb: <strong>' . $value["roomNumb"] . '</strong></p>
                        <p>Language: <strong>' . $value["language"] . '</strong></p>
                    </div>
                </div>
                <div class="d-flex infoContainer">
                    <div class="imgCard">
                        <img src="../Images/calendar.png" alt="">
                    </div>
                    <div>
                        <p>Start date: <strong>' . $value["date"] . '</strong></p>
                        <p>End date: <strong>' . $value["end_date"] . '</strong></p>
                    </div>
                </div>
            </div>
            <div class="detailsBtn">
                <form method="post" style="margin: 0;">
                    <input class="btnDetails bg-success" type="submit" name="bookings" value="book course">
                </form>
                <div class="btnDetails" style="background-color: #F99646; color: #fff;">
                    <a href="review.php?course_id=' . $value["id"] . '&user_id=' . $id . '">rate this course</a>
                </div>
                <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
                    <a href="dashboardUser.php">back to home</a></div>
                </div>
            </div>
        </div>';
    }
}else {
    $courses = "no courses found";
}




// $res = mysqli_query($connection, $sqlGetCourses);

// $layout = "";

// if (mysqli_num_rows($res) == 0) {
//     $layout= "There are no Course yet!";
// } else {
//     // Abfrage, um die Details des Kurses abzurufen
//     $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
//     foreach ($data as $val) {
//         // Kursdetails anzeigen
//         $layout .= "
//                 <p>Student First Name: {$val["firstName"]}</p>
//                 <p>Student Second Name: " . $val['secondName'] . "</p>
//                 <p>Student email: {$val["email"]}</p>
//                 <a href='removeStudent.php?studentId={$val["booking_id"]}'>Remove student</a>
//                     ";
//     }
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

    <br>
    <?= $courses ?>

    <br>
    <h1>All the students, that takes this course:</h1>
    <?= $layout ?>
</body>

</html>