<?php

session_start();


require_once "db_connection.php";

$id = $_GET["id"];
$selectID = "SELECT * FROM courses WHERE university like '%$id%'";

$result = mysqli_query($connection, $selectID);

$layout = "";
$universities = "";
$subjects = "";

if (mysqli_num_rows($result) == 0) {
    $layout = "No courses found!";
} else {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($rows as $value) {
        $date =  strtotime($value["date"]);
        $date = date("j F Y", $date);
        $layout .= "
        <div class='course'>
        <div class='course-left'>
            <div class='card-holder'>
                <img class='card-img' src='/Images/{$value["picture"]}' alt='Image description' />
                <h4 class='card-title'>More Information</h4>
                <a href='details4all.php?id={$value["id"]}' class='card-btn'>Details</a>
            </div>
            </div>
            <div class='info'>
                <h4 class='course-title'>{$value["subject"]}(m/w/d)</h4>
                <p class='course-date'>{$date} Duration: {$value["duration"]}mins.</p>
                <p class='course description'>
                    The media group around the oe24 network is one of the young and
                    dynamic players on the domestic market. With a newly established
                    internal structure, flat hierarchies and a young management team.
                </p>
            </div>
        </div>
        <div class='splitter'></div>
        ";
    }
    foreach ($rows as $value) {
        $universities .= "<a class='btn btn-primary' type='button' href='http://localhost:3000/universityFilter.php?id={$value['university']}'>{$value['university']}</a>";
    }
    foreach ($rows as $value) {
        $subjects .= "<a class='btn btn-primary' type='button' href='http://localhost:3000/subjectsFilter.php?id={$value['subject']}'>{$value['subject']}</a>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/courses.css">
</head>

<body>
    <div class="background">
        <img class="bkgr" src="/Images/courses-banner.jpg" alt="">
        <div class="hero">
            <div class="left">
                <h3 class="title">The courses in Tutor Masters</h3>
                <h5>Our courses are designed to empower students with the knowledge and skills needed for university admission success. We offer personalized tutoring sessions tailored to individual learning styles, comprehensive study materials, and expert guidance from leading educators. Our goal is to provide a supportive and enriching learning experience that enables students to excel academically and achieve their educational aspirations.</h5>
            </div>
            <div class="right">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="courses">
            <h2 class="upcoming">All Courses</h2>
            <div class="courses-flex">
                <div class="filter">
                    <h4 class="universities">Universities:</h4>
                    <?= $universities ?>
                    <h4 class="subjects">Subjects:</h4>
                    <?= $subjects ?>
                </div>
                <div class="list">
                    <?= $layout ?>

                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>