<?php

session_start();

// Validation==========================================================================

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION
["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
  }
  
  if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/dashboardTrainer.php");
  }
  
// ==============================================================================

require_once "../db_connection.php";

$id = $_GET["id"];

if (isset($_SESSION["admin"])) {

    $sqlUser= "SELECT courses.*, users.firstName,users.secondName,users.email, bookings.id as booking_id FROM users JOIN bookings ON bookings.fk_user_id = users.id JOIN courses ON bookings.fk_course_id = courses.id WHERE courses.id = $id";
   
    $runSqlUser = mysqli_query($connection, $sqlUser);
    // $rowsUser = mysqli_fetch_assoc($runSqlUser);

    $layout = "";

    
$usersDetails = "";
    if (mysqli_num_rows($runSqlUser) == 0) {
        $layout = "There are no Course Bookings yet!";
        
    } else {

            $row = mysqli_fetch_all($runSqlUser, MYSQLI_ASSOC); 
          
// Print info about students that are assigning this course==================================================

            foreach ($row as $val) {
                
                $usersDetails .= "<p>First Name: {$val["firstName"]}</p>
                <p>Second Name: {$val["secondName"]}</p>
                <p>Email: {$val["email"]}</p>";
            }
// ================================================================================

// Print info about this course=================================================================

            $layout .= '

            <div class="detailContainer">
        <div>
            <h1 class="">' . $row[0]["subject"] . '</h1>
        </div>
        <div class="topCard">
            <div class="leftCard">
                <ul style="">
                    <li>
                        <a href="teacherDetail.php?email=' . $row[0]["email"] . '">Teacher: <strong>' . $row[0]["teacher"] . '</strong></a>
                    </li>
                    <li>
                        <p>University: <strong>' . $row[0]["university"] . '</strong></p>
                    </li>
                   
                    <li>
                    <p>Capacity left: <strong>' . $row[0]["capacity"] . '</strong></p>
                </li>
                <li>
                <p>Availability: <strong>' . $row[0]["availability"] . '</strong></p>
            </li>
                </ul>
            </div>
            <img src=../Images/' . $row[0]["picture"] . ' class="" alt="...">
        </div>
        <div class="d-flex justify-content-between infoBox">
            <div class="d-flex infoContainer">
                <div class="imgCard">
                    <img src="../Images/flag.png" alt="">
                </div>
                <div>
                    <p>RoomNumb: <strong>' . $row[0]["roomNumb"] . '</strong></p>
                    <p>Language: <strong>' . $row[0]["language"] . '</strong></p>
                </div>
            </div>
            <div class="d-flex infoContainer">
                <div class="imgCard">
                    <img src="../Images/calendar.png" alt="">
                </div>
                <div>
                    <p>Start date: <strong>' . $row[0]["date"] . '</strong></p>
                    <p>End date: <strong>' . $row[0]["end_date"] . '</strong></p>
                </div>
            </div>
        </div>
    <div class="detailsBtn">
        <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
            <a href="dashboardAdmin.php">back to home</a>
            </div>
            <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
            <a href="deleteBookings.php?id= . $row[0]["booking_id"] . ">Delete</a>
            </div>
        </div>
    </div>
    </div>
  ';
    }
}

// ==============================================================================================

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/details.css">
</head>

<body>
    <div class="containerPage">
        <div>
            <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
            <div class="detail">
                <div>
                    <?= $layout ?>
                </div>
            </div>
        </div>
        <?= $usersDetails ?>
    </div>
</body>

</html>