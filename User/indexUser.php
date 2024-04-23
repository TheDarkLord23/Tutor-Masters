<?php

require_once "../db_connection.php";

$readQuery = "SELECT * from courses";
$readResult = mysqli_query($connection, $readQuery);

$layout = "";


if (mysqli_num_rows($readResult) == 0) {
    $layout = "No courses found!";
} else {
    $rows = mysqli_fetch_all($readResult, MYSQLI_ASSOC);
    foreach ($rows as $value) {
        $layout .= "<div class='center'>
        <div class='card' style='width: 18rem;'>
        <img src='img/{$value["picture"]}' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>{$value["subject"]}</h5>
          <p class='card-text'>Date:{$value["date"]}</p>
          <p class='card-text'>Duration:{$value["duration"]}</p>
          
          <a href='details.php?id={$value["id"]}' class='btn btn-success'>Details</a>
      </div>
      </div>
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
    <link rel="stylesheet" href="../style/indexUser.css">
</head>

<body>
     <nav class="navbar bg-body-tertiary">
        <div class="container">
         
           
            <a class="navbar-brand" href="subjectsFilter.php">
                filter classes
            </a>
            <a class="navbar-brand" href="universityFilter.php">
                filter university
            </a>
            <a class="navbar-brand" href="updateprofile.php">
                Update profile
            </a>

            <a class="navbar-brand" href="../login/logout.php?logout">
                Logout
            </a>
        </div>
    </nav>  


<div class="med-related-prod-wrap" id="med-related-prod-wrapper">
<h2 class="related-prod-heading">All Subjects</h2>
<div class="med-rel-prod-slider-wrapper">
<div class="med-rel-prod-slider carousel-content">

<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">Mathematics</a>
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">Computer Science</a>
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
    <a href="subjectsFilter.php" class="rel-med-name">Literature</a>
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">History</a>
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">Biology</a>
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">Chemistry</a>
    </div>
</div>

</div>

    </div>
</div>

<br>
<div class="med-related-prod-wrap" id="med-related-prod-wrapper">
    <h2 class="related-prod-heading">All Universities</h2>
    <div class="med-rel-prod-slider-wrapper">
        <div class="med-rel-prod-slider carousel-content">

<div class="med-product-card">
    <div class="related-prod-detail">
    <a href="subjectsFilter.php" class="rel-med-name">University of Vienna</a>
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
    <a href="subjectsFilter.php" class="rel-med-name">Vienna University of Technology</a>
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">University of Graz</a>
    </div>
</div>


<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">University of Innsbruck</a>
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">Medical University of Vienna</a>
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">University of Salzburg</a> 
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">University of Klagenfurt </a>
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">Graz University of Technology</a>
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">Johannes Kepler University Linz</a>
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <a href="subjectsFilter.php" class="rel-med-name">University of Veterinary Medicine Vienna</a>
    </div>
</div>
</div>

<br><br>
    <div width="100%">

        <div class="cont" width="100%">
       
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5  grid" width="100%">
            <?= $layout ?>
        </div>
    </div>

    <script>
    const bindCarouselEvents = (containerId) => {
        const wrapper = document.getElementById(containerId);
        const btn_left = wrapper.getElementsByClassName('btn-left')[0]
        const btn_right = wrapper.getElementsByClassName('btn-right')[0]
        const content = wrapper.getElementsByClassName('carousel-content')[0]
        const content_scroll_width = content.scrollWidth;
        let content_scoll_left = content.scrollLeft;
        if (btn_right) {
            btn_right.addEventListener('click', () => {
                content_scoll_left += 224;
                if (content_scoll_left >= content_scroll_width) { 
                    content_scoll_left = content_scroll_width;
                }
                content.scrollLeft = content_scoll_left;
            });
        }
        if (btn_left) {
            btn_left.addEventListener('click', () => {
                content_scoll_left -= 224;
                content.scrollLeft = content_scoll_left;
            });
        }

        // scroll binding
        content.addEventListener('scroll', () => {
            let scrollLeft = Math.ceil(content.scrollLeft)
            let contentScrollWidth = content.scrollWidth
            let contentWidth = content.clientWidth
            let rightEdge = (contentScrollWidth - contentWidth)
            if (scrollLeft >= rightEdge) {
                btn_right.style.display = "none"
            } else if (scrollLeft < rightEdge) {
                btn_right.style.display = "block"
            }

            if (scrollLeft == 0) {
                btn_left.style.display = "none"
            } else if (scrollLeft > 0) {
                btn_left.style.display = "block"
            }

            content_scoll_left = scrollLeft
        });
    }

    // javascript for scroll on click
    window.addEventListener('DOMContentLoaded', function(){
        bindCarouselEvents('med-related-prod-wrapper')
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>