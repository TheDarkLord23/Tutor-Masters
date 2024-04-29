<?php
session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

require_once "../db_connection.php";
require_once "../navbar_session.php";

$userId = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = $userId";
$result = mysqli_query($connection, $query);

$layout = "";

if (!$result) {
    die("Database query failed: " . mysqli_error($connection));
} else {
    $user = mysqli_fetch_assoc($result);
    $layout .= "
        <img class='circle-image' src='../Images/{$user["picture"]}' alt=''>
        <h2>{$user["firstName"]} {$user["secondName"]}</h2>
        <p>Email: {$user["email"]}</p>
        <p>Address: {$user["address"]}</p>
        <p>Phone: {$user["phoneNumber"]}</p>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="left-section">
            <a href="dashboardUser.php" class="action action-active">
                <div class="icon"></div>
                <div class="title">Action 1</div>
            </a>
            <a href="action2.php" class="action">
                <div class="icon"></div>
                <div class="title">Action 2</div>
            </a>
            <a href="action3.php" class="action">
                <div class="icon"></div>
                <div class="title">Action 3</div>
            </a>
            <a href="action4.php" class="action">
                <div class="icon"></div>
                <div class="title">Action 4</div>
            </a>
        </div>
        <div class="center-section">
            <h2 class="dashboard-title">Dashboard</h2>
            <div id="current-date"></div>
            <!-- <div class="navigation"></div> -->
            <div>
                <div class="hello">
                    <img class="graphs" src="../Images/graphs.png" alt="">
                    <div class="hello-right">
                        <h2>Hello, <?php echo $user['firstName'] . ' ' . $user['secondName']; ?></h2>
                        <h5>This is your Dashboard. Here you can see all your info. You can edit your Profile. View and Edit your Courses. View and Edit your Reviews. You can see your Calendar and change the dates for a Course you have already signed up for.</h5>
                    </div>
                </div>
                <div class="content">
                    <div class="items-left">
                        <!-- <div class="grid">
                            <div class="box">
                                <div class="icon">Icon 1</div>
                                <div class="text">Text 1</div>
                            </div>
                            <div class="box">
                                <div class="icon">Icon 2</div>
                                <div class="text">Text 2</div>
                            </div>
                            <div class="box">
                                <div class="icon">Icon 3</div>
                                <div class="text">Text 3</div>
                            </div>
                            <div class="box">
                                <div class="icon">Icon 4</div>
                                <div class="text">Text 4</div>
                            </div>
                        </div> -->
                        <div class="box">
                            <img src="../Images/star-full.png" class="icon-big" alt="">
                            <h2 class="text">My Reviews</h2>
                        </div>
                        <div class="box">
                            <img src="../Images/open-book.png" class="icon-big" alt="">
                            <h2 class="text">My Courses</h2>
                        </div>
                    </div>
                    <div class="items-right">

                    </div>
                </div>
            </div>
        </div>
        <div class="right-section">
            <div class="profile-info">
                <?= $layout ?>
                <a class="updateInput" href="courses.php">
                    <input class="updateBtn" type="submit" name="update" value="Update Profile">
                </a>
            </div>
        </div>
    </div>

    <script>
        var currentDate = new Date();

        var options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        var formattedDate = currentDate.toLocaleDateString('en-US', options);

        document.getElementById('current-date').textContent = formattedDate;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>