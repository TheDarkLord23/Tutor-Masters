<?php



session_start();

include_once '../db_connection.php';


if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
  header("Location: ../login/login.php");
}



$user_id = $_SESSION['user'];


$booking_query = "SELECT * FROM bookings WHERE fk_user_id = $user_id";
$booking_result = mysqli_query($connection, $booking_query);

$layout = "";

if (mysqli_num_rows($booking_result) == 0) {
  $layout = "You haven't booked any courses yet!";
} else {
  while ($booking_row = mysqli_fetch_assoc($booking_result)) {
    $course_id = $booking_row['fk_course_id'];
    // Abfrage, um die Details des Kurses abzurufen
    $course_query = "SELECT * FROM courses WHERE id = $course_id";
    $course_result = mysqli_query($connection, $course_query);
    if ($course_result && mysqli_num_rows($course_result) == 1) {
      $course_row = mysqli_fetch_assoc($course_result);
      
      // Kursdetails anzeigen
      $layout .= "
      <div class='course'>
          <div class='course-left'>
              <div class='card-holder'>
                  <img class='card-img' src='/Images/{$course_row["picture"]}' alt='Image description' />
                  <h4 class='card-title'>More Information</h4>
                  <a href='details.php?id={$course_row["id"]}' class='card-btn'>Details</a>
              </div>
          </div>
          <div class='info'>
              <h4 class='course-title'>{$course_row["subject"]}(m/w/d)</h4>
              <p class='course-date'>Duration: {$course_row["duration"]}mins.</p>
              <p class='course description'>
                  The media group around the oe24 network is one of the young and
                  dynamic players on the domestic market. With a newly established
                  internal structure, flat hierarchies and a young management team.
              </p>
          </div>
          <div class='submitBtnContainer'>
            <button class='submitBtn' style=''><a href='deletecourses.php?id={$booking_row['id']}'>Delete</button>
            <button class='submitBtn bg-danger' style=''><a style='text-decoration: none; color: #fff;' href='deletecourse.php?id={$course_row['id']}'>Delete</a></button>
            <button class='submitBtn' style='margin: 0;'><a style='text-decoration: none; color: #fff;' href='details.php?id={$course_row['id']}'>Details</a></button>
          </div>
          
      </div>
      <div class='splitter'></div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Booked Courses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/CRUD.css">
</head>

<body>
  <div class="container">
    <div class="courses">
      <h2 class="">My Booked Courses</h2>
      <div class="list">
        <?= $layout ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>