<?php 



session_start();

include_once '../db_connection.php';


if (!isset($_SESSION['user'])) {
    header("Location: ../login/login.php");
    exit;
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
            $layout .= "<div class='center'>
                <div class='card' style='width: 18rem;'>
                    <img src='img/{$course_row["picture"]}' class='card-img-top' alt='Course Image'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$course_row["subject"]}</h5>
                        <p class='card-text'>Date: {$course_row["date"]}</p>
                        <p class='card-text'>Duration: {$course_row["duration"]}</p>
                        <a href='details.php?id={$course_row["id"]}' class='btn btn-success'>Details</a>
                    </div>
                </div>
            </div>";
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
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="updateprofile.php">Update profile</a>
            <a class="navbar-brand" href="../login/logout.php?logout">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">My Booked Courses</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?= $layout ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
