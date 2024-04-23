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

            <a class="navbar-brand" href="logout.php?logout">
                Logout
            </a>
        </div>
    </nav>  

    

    <br><br>
    <div width="100%">
        
       
        <div class="cont" width="100%">
       
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5  grid" width="100%">
            <?= $layout ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>