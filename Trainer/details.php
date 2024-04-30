<?php
session_start();
if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}
if (isset($_SESSION["user"])) {
    header("Location: ../User/indexUser.php");
}

require_once "../db_connection.php";






$userId = $_SESSION['user_id'];



$id = $_GET['id'];
$sqlTrainerDetails = "SELECT * FROM users WHERE id = {$userId}";
$result = mysqli_query($connection, $sqlTrainerDetails);
$row = mysqli_fetch_assoc($result);
$TrainerEmail = $row['email'];

// Kurse abrufen, die dem Trainer zugeordnet sind
$courses = "";
$sqlGetCourses = "SELECT * FROM `courses` WHERE email = '{$TrainerEmail}'";
$courses_result = mysqli_query($connection, $sqlGetCourses);
if (mysqli_num_rows($courses_result) > 0) {
    $rows = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);
    foreach ($rows as $row) {
        $course_id = $row['id'];
        $courses .= '
        <div class="detailContainer">
            <div>
                <h1 class="">' . $row["subject"] . '</h1>
            </div>
            <div class="topCard">
                <div class="leftCard">
                    <ul style="">
                        <li>
                            <a href="teacherDetail.php?email=' . $row["email"] . '">Teacher: <strong>' . $row["teacher"] . '</strong></a>
                        </li>
                        <li>
                            <p>University: <strong>' . $row["university"] . '</strong></p>
                        </li>
                       
                        <li>
                        <p>Capacity left: <strong>' . $row["capacity"] . '</strong></p>
                    </li>
                    <li>
                    <p>Availability: <strong>' . $row["availability"] . '</strong></p>
                </li>
                    </ul>
                </div>
                <img src=../Images/' . $row["picture"] . ' class="" alt="...">
            </div>
            <div class="d-flex justify-content-between infoBox">
                <div class="d-flex infoContainer">
                    <div class="imgCard">
                        <img src="../Images/flag.png" alt="">
                    </div>
                    <div>
                        <p>RoomNumb: <strong>' . $row["roomNumb"] . '</strong></p>
                        <p>Language: <strong>' . $row["language"] . '</strong></p>
                    </div>
                </div>
                <div class="d-flex infoContainer">
                    <div class="imgCard">
                        <img src="../Images/calendar.png" alt="">
                    </div>
                    <div>
                        <p>Start date: <strong>' . $row["date"] . '</strong></p>
                        <p>End date: <strong>' . $row["end_date"] . '</strong></p>
                    </div>
                </div>
            </div>
            <div class="detailsBtn">
                
                <div class="btnDetails" style="background-color: #F99646; color: #fff;">
                    <a href="review.php?course_id=' . $row["id"] . '&user_id=' . $id . '">rate this course</a>
                </div>
                <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
                    <a href="dashboardUser.php">back to home</a></div>
                </div>
            </div>
        </div>';
    }
} else {
    $courses = "No courses found";
}
$userId = $_SESSION['user_id'];

$sqlUser= "SELECT * FROM `courses` WHERE `id` = $userId";


$runSqlUser = mysqli_query($connection, $sqlUser);



// Annahme: $course_id ist die ID des Kurses, die aus der URL oder anderweitig erhalten wurde
$course_id = $_GET['id'];

$sqlGetBookingId = "SELECT bookings.id FROM bookings";
$result1 = mysqli_query($connection, $sqlGetBookingId);
$booking_id = $row['id'];


$sqlGetUser = "SELECT users.id
                FROM users
                JOIN bookings ON users.id = bookings.fk_user_id
                JOIN courses ON bookings.fk_course_id = courses.id
                WHERE courses.id = $course_id";

// Führen Sie die Abfrage aus und holen Sie die Ergebnisse ab
$result2 = mysqli_query($connection, $sqlGetUser);


// Führen Sie die SQL-Abfrage aus
$sqlGetUsers = "SELECT users.firstName, users.secondName, users.email, users.id
                FROM users
                JOIN bookings ON users.id = bookings.fk_user_id
                JOIN courses ON bookings.fk_course_id = courses.id
                WHERE courses.id = $course_id";

// Führen Sie die Abfrage aus und holen Sie die Ergebnisse ab
$result = mysqli_query($connection, $sqlGetUsers);

$row1 = mysqli_fetch_assoc($result);
$user_id = $row1['id'];

// var_dump($row1);
var_dump($result);

$layout1 = "";

if (mysqli_num_rows($result) == 0) {
    $layout1 = "There are no Students yet!";
} else {
    $layout1 = "<table class='student-table'>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>";

                    mysqli_data_seek($result, 0);

    while ($value = mysqli_fetch_assoc($result)) {
        $layout1 .= "<tr>
                        <td>{$value["firstName"]}</td>
                        <td>{$value["secondName"]}</td>
                        <td>{$value["email"]}</td>
                        <td><a href='removeStudent.php?courseId={$booking_id}&userid={$value["id"]}'>Remove student</a></td>
                    </tr>
                </table>";
}
}
// <tr>
// <td>{$valu["firstName"]}</td>
// <td>{$valu["secondName"]}</td>
// <td>{$valu["email"]}</td>
// <td><a href='removeStudent.php?courseId={$booking_id}&userid={$user_id}'>Remove student</a>
// </tr>
// </table>
        
                
                
//                     ";


//     }};





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Details</title>
    <link rel="stylesheet" href="../style/details.css">
<style>.student-table {
    width: 100%;
    border-collapse: collapse;
}

.student-table th, .student-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.student-table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.student-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.student-table tr:hover {
    background-color: #ddd;
}
</style>
</head>

<body>
    <div>
    <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
    <div class="detail">
            <div>
    <?= $courses ?>
    </div>
        </div>
    <br> <br> <br> <br> <br> <br>  <br> <br> <br> <br> <br> <br><br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
   
   

    <br><h1>All the students enrolled in this course:</h1>
    <?= $layout1 ?></div>
</body>

</html>
