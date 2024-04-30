<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

require_once "../db_connection.php";
require_once "../navbar_session.php";


$readQuery = "SELECT * FROM courses";
$readResult = mysqli_query($connection, $readQuery);


$layout = "";
$universities = "";
$subjects = "";


if (mysqli_num_rows($readResult) == 0) {
    $layout = "No courses found!";
} else {
    $rows = mysqli_fetch_all($readResult, MYSQLI_ASSOC);

    foreach ($rows as $index => $value) {
        $date = strtotime($value["date"]);
        $date = date("j F Y", $date);
        $layout .= "
        <div class='course'>
            <div class='course-left'>
                <div class='card-holder'>
                    <img class='card-img' src='/Images/{$value["picture"]}' alt='Image description' />
                    <h4 class='card-title'>More Information</h4>
                    <a href='details.php?id={$value["id"]}' class='card-btn'>Details</a>
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
        </div>";
        if ($index < count($rows) - 1) {
            $layout .= "<div class='splitter'></div>";
        }
    }

    foreach ($rows as $value) {
        $universities .= "<button class='btn btn-primary university-filter' type='button' data-filter='university' data-id='{$value['university']}'>{$value['university']}</button>";
    }
    foreach ($rows as $value) {
        $subjects .= "<button class='btn btn-primary subject-filter' type='button' data-filter='subject' data-id='{$value['subject']}'>{$value['subject']}</button>";
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
    <link rel="stylesheet" href="../style/courses.css">
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
            <h2 id="course-title" class="upcoming">All Courses</h2>
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
    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".university-filter, .subject-filter").forEach(function(button) {
                button.addEventListener("click", function() {
                    var filterType = this.getAttribute("data-filter");
                    var filterId = this.getAttribute("data-id");
                    var filterName = this.textContent.trim();
                    var isSelected = this.classList.contains("selected");

                    if (isSelected) {
                        resetFilter();
                    } else {
                        updateCourseTitle(filterType, filterId, filterName);
                        filterCourses(filterType, filterId, this);
                        setSelectedFilterButton(this);
                    }
                    updateCourseTitle(filterType, filterId, filterName);
                    filterCourses(filterType, filterId, this);
                });
            });

            function updateCourseTitle(filterType, filterId, filterName) {
                var title;
                if (filterType === 'university') {
                    title = "Courses in " + filterName;
                } else if (filterType === 'subject') {
                    title = filterName + " Courses";
                } else {
                    title = "All Courses";
                }
                document.getElementById("course-title").textContent = title;
            }

            function resetFilter() {
                window.location.href = 'courses.php';
            }

            function filterCourses(filterType, filterId, button) {

                var xhr = new XMLHttpRequest();
                xhr.open("GET", "../filter_courses.php?type=" + filterType + "&id=" + filterId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {

                        $layout = xhr.responseText;
                        document.querySelector(".list").innerHTML = $layout;

                        document.querySelectorAll(".university-filter, .subject-filter").forEach(function(btn) {
                            btn.classList.remove("selected");
                        });
                        button.classList.add("selected");
                    }
                };
                xhr.send();
            }
        });
    </script>

</body>

</html>