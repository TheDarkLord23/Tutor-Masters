<?php

require_once "db_connection.php";
require_once "navbar.php";
// require_once "footer.php";

$readQuery = "SELECT * FROM courses
ORDER BY `date` ASC LIMIT 4";
$readResult = mysqli_query($connection, $readQuery);


$layout = "";
$body1 = "";
$body2 = "";

$queryFilter = "SELECT * from courses";
$filterResult = mysqli_query($connection, $queryFilter);




if (mysqli_num_rows($filterResult) == 0) {
    $body1 = "No courses found!";
} else {
    $data1 = mysqli_fetch_all($filterResult, MYSQLI_ASSOC);
    foreach ($data1 as $val1) {

        $body1 .= "<a href='subjectsFilter.php?id={$val1['subject']}'>{$val1['subject']}</a>";
    }
}


$queryFilterUni = "SELECT * from courses";
$filterResultUni = mysqli_query($connection, $queryFilterUni);

if (mysqli_num_rows($filterResultUni) == 0) {
    $body2 = "No courses found!";
} else {
    $data2 = mysqli_fetch_all($filterResultUni, MYSQLI_ASSOC);
    foreach ($data2 as $val2) {

        $body2 .= "<a href='universityFilter.php?id={$val2['university']}'>{$val2['university']}</a>";
    }
}




if (mysqli_num_rows($readResult) == 0) {
    $layout = "No courses found!";
} else {
    $rows = mysqli_fetch_all($readResult, MYSQLI_ASSOC);
    foreach ($rows as $value) {
        $layout .= "
        <div class='card-holder'>
            <img src='img/{$value["picture"]}' alt='Image description' />
            <h4>{$value["subject"]}</h4>
            <p>
            Date:{$value["date"]}
            </p>
            <p>
            Duration:{$value["duration"]}
            </p><a href='details4all.php?id={$value["id"]}' class='card-btn'>Details</a>
        </div>";
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
    <link rel="stylesheet" href="./style/index.css">
</head>

<body>
    <div class="background">
        <img class="bkgr" src="/Images/backgr.jpg" alt="">
        <div class="hero">
            <div class="left">
                <h1 class="title">Unlock your potential<br> with the best<br> univercity tutors.</h1>
                <a class="submitInput" href="courses.php">
                    <input class="submitBtn" type="submit" name="submit" value="Get Started">
                </a>
            </div>
            <div class="right">
                <img class="banner" src="images/banner.png" alt="">
            </div>
        </div>
    </div>
    <div class="info">
        <div class="grid">
            <div class="grid-item">
                <div><img class="icon" src="/Images/star.png" alt=""></div>
                <div>
                    <h6>Expert teaching staff comprised of leading educators in various fields.</h6>
                </div>
            </div>
            <div class="grid-item">
                <div><img class="icon" src="/Images/person.png" alt=""></div>
                <div>
                    <h6>Personalized mentorship tailored to individual learning styles and needs.</h6>
                </div>
            </div>
            <div class="grid-item">
                <div><img class="icon" src="/Images/book.png" alt=""></div>
                <div>
                    <h6>Comprehensive study materials and resources to aid in exam preparation.</h6>
                </div>
            </div>
            <div class="grid-item">
                <div><img class="icon" src="/Images/seo.png" alt=""></div>
                <div>
                    <h6>Proven strategies and techniques for optimizing academic performance.</h6>
                </div>
            </div>
            <div class="grid-item">
                <div><img class="icon" src="/Images/calendar.png" alt=""></div>
                <div>
                    <h6>Flexible scheduling options to accommodate busy student lifestyles.</h6>
                </div>
            </div>
            <div class="grid-item">
                <div><img class="icon" src="/Images/flag.png" alt=""></div>
                <div>
                    <h6>Continuous support and guidance throughout the university admission process.</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="courses">
            <h3 class="upcoming">Upcoming Courses</h3>
            <div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1">
                <?= $layout ?>
            </div>
            <a class="submitInput" href="courses.php">
                <input class="courses-btn" type="submit" name="submit" value="All Courses">
            </a>
        </div>
    </div>

    <div class="testimonials">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="..." alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="..." alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="..." alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>