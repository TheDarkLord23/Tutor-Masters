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
          <div class='btnAlign'>
          <a href='book.php?id={$value['id']}' class='btn btn-warning'>book course</a>
          <a href='details.php?id={$value["id"]}' class='btn btn-success'>Details</a>
       </div> </div>
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
    <title>Hello <?= $row["firstName"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

.cont{
    display: flex;
    justify-content: center;
    align-content: center;
}
.center{
    display: flex;
    justify-content: center;
    align-content: center;
    margin-bottom: 2rem;
}
.grid{
    
    width: 100%;
    align-content: center;
    justify-content: center;
}
.card{
    
    width: 100%;
    align-content: center;
    justify-content: center;
}
.card-title, .card-text{
    text-align: center;
}
.btnAlign{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    
}
.med-related-prod-wrap{
    margin: 40px 16px 0px 16px;
}
.med-related-prod-wrap .related-prod-heading{
    margin: 0px;
    font-size: 18px;
}
.med-related-prod-wrap .med-rel-prod-slider{
    display: flex;
    column-gap: 8px;
    margin-top: 20px;
    overflow: auto;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    scroll-behavior: smooth;
}
.med-related-prod-wrap .med-rel-prod-slider::-webkit-scrollbar {
    display: none;
}
.med-slider-arrow-section{
    display: none;
    align-items: center;
    justify-content: end;
    margin-top: 40px;
    column-gap:10px;
}
.med-slider-arrow{
    --size: 30px;
    z-index: 9;
    background: #ffffff;
    width: var(--size);
    height: var(--size);
    border-radius: var(--size);
    -webkit-transition: opacity .5s,visibility .5s;
    transition: opacity .5s,visibility .5s;
    border: 1px solid #dfe1e5;
    box-shadow: 0 0 0 1px rgb(0 0 0 / 4%), 0 4px 8px 0 rgb(0 0 0 / 20%);
    padding: 0;
    transform: translate(0,-50%);
    cursor: pointer;
    outline: 0!important;
    transition: 0.2s ease-in-out;
}
.med-slider-arrow:after {
    background-image:  url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 12H19' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 5L19 12L12 19' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-size: 16px;
    content: '';
    width: var(--size);
    height: var(--size);
    display: block;
    background-repeat: no-repeat;
    background-position: 49% 50%;
    transform:rotate(180deg);
}
.med-slider-arrow.btn-left{
    display: none;
}
.med-slider-arrow.med-slider-next:after{
    transform:rotate(360deg);
}
.med-rel-prod-slider .med-product-card{
    display: inline-grid;
    grid-auto-rows: min-content auto;
    text-align: center;
    
    padding: 5px 5px;
    background: #FFFFFF;
    border: 1px solid #E5E5F0;
    border-radius: 15px;
    width: 224px;
    flex-shrink: 0;
    cursor: pointer;
    overflow: hidden;
}
.med-rel-prod-slider .med-product-card:hover .related-prod-img{
    transform: scale(1.1);
}
.med-product-card .related-prod-wrapper{
    height: 140px;
    width: 100%;
    overflow: hidden;
}
.related-prod-wrapper .related-prod-img{
    height: 100%;
    width: 100%;
    object-fit: contain;
    transition: 0.5s all ease-in-out;
}
.med-product-card .rel-med-name{
    
    font-size: 24px;
    padding-top: 0px;
    color: #232426;
}
.med-product-card .rel-no-of-tab{
    color: #878787;
    font-size: 18px;
    
}
.med-product-card .rel-company-name{
    color: #232426;
    font-size: 14px;
    text-decoration: underline;
    font-weight: 600;
    
}
.med-product-card .rel-prod-price{
    font-weight: 600;
    font-size: 24px;
    margin-bottom: 0px;
}
.med-product-card .related-prod-detail{
     margin-top:auto;
   
}   
@media (min-width: 992px){
.med-related-prod-wrap{
    margin: 0px 0px 50px 0px;
}
.med-related-prod-wrap .related-prod-heading{
    margin: 0px;
    font-size: 26px;
}
.med-related-prod-wrap .med-rel-prod-slider{
    margin-top: 40px;
}
.med-slider-arrow-section{
    display: flex;
}
}
    </style>
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

    

    <br><br>
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
        <a href="" class="rel-med-name">Computer Science</p>
      
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Physics</p>
      
    </div>
</div>


<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Literature</p>
      
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">History</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Biology</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Chemistry</p>
      
  
</div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Geography</p>
      
    
</div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Economics</p>
      
    
</div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Art</p>
      
    
</div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">Biology</p>
      
    </div>
</div>

</div>
        <div class="med-slider-arrow-section">
            <button class="med-slider-prev med-slider-arrow btn-left" aria-label="left-arrow" onclick="" id="med-btn-left" type="button"></button>
            <button class="med-slider-next med-slider-arrow btn-right" aria-label="right-arrow" onclick="" id="med-btn-right" type="button"></button>
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
        <p class="rel-med-name">ABC University</p>
      
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">XYZ College</p>
      
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">123 Institute</p>
      
    </div>
</div>


<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">DEF School</p>
      
    </div>
</div>

<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">GHI University</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">MNO College</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">PQR Institute</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">STU School</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">VWX College</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">YZA University</p>
      
    </div>
</div>
<div class="med-product-card">
    <div class="related-prod-detail">
        <p class="rel-med-name">university of vienna</p>
      
    </div>
</div>

</div>
        <div class="med-slider-arrow-section">
            <button class="med-slider-prev med-slider-arrow btn-left" aria-label="left-arrow" onclick="" id="med-btn-left" type="button"></button>
            <button class="med-slider-next med-slider-arrow btn-right" aria-label="right-arrow" onclick="" id="med-btn-right" type="button"></button>
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