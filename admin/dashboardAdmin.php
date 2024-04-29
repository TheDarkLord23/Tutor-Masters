<?php
session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/dashboardTrainer.php");
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
            <a href="dashboardUser.php" class="action action-active" id="dashboardBtn">
                <img class="icon" src="../Images/house-black.png" alt="">
                <div class="title">Dashboard</div>
            </a>
            <a href="#" class="action" id="action2Btn">
                <img class="icon" src="../Images/book-black.png" alt="">
                <div class="title">All Courses</div>
            </a>
            <a href="#" class="action" id="action3Btn">
                <img class="icon" src="../Images/person-black.png" alt="">
                <div class="title">All Users</div>
            </a>
            <a href="#" class="action" id="action4Btn">
                <img class="icon" src="../Images/calendar-black.png" alt="">
                <div class="title">All Bookings</div>
            </a>
        </div>
        <div class="center-section" id="centerSection">
            <div class="center-left">
                <h2 class="dashboard-title">Dashboard</h2>
                <div id="current-date"></div>
                <!-- <div class="navigation"></div> -->
                <div>
                    <div class="hello">
                        <img class="graphs" src="../Images/graphs.png" alt="">
                        <div class="hello-right">
                            <h2>Hello, <?php echo $user['firstName'] . ' ' . $user['secondName']; ?></h2>
                            <h5>This is your Dashboard. Here you can see all your info. You can edit your Profile. View and Edit all Courses. View and Edit all Users. And view and Edit all Bookings.</h5>
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
            <div class="center-right">
                <div class="profile-info">
                    <?= $layout ?>
                    <a class="updateInput" href="updateprofile.php">
                        <input class="updateBtn" type="submit" name="update" value="Update Profile">
                    </a>
                    <a class="logoutInput" href="../login/logout.php">
                        <input class="logout" type="submit" name="logout" value="Logout">
                    </a>
                </div>

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

        // Function to handle dashboard button click (refresh page)
        document.getElementById('dashboardBtn').addEventListener('click', function(event) {
            location.reload();
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Get reference to center section and action buttons
            var centerSection = document.getElementById("centerSection");
            var actionButtons = document.querySelectorAll(".action");

            // Function to handle button click
            function handleButtonClick(event) {
                event.preventDefault();

                // Check if the clicked button is not already active
                if (!this.classList.contains("action-active")) {
                    // Remove action-active class from all buttons
                    actionButtons.forEach(function(btn) {
                        btn.classList.remove("action-active");
                    });

                    // Add action-active class to the clicked button
                    this.classList.add("action-active");

                    // Get the href attribute of the clicked button
                    var href = this.getAttribute("href");

                    // Fetch the content from the href
                    fetch(href)
                        .then(response => response.text())
                        .then(data => {
                            // Update the center section with the fetched content
                            centerSection.innerHTML = data;
                        })
                        .catch(error => console.error("Error:", error));
                }
            }

            // Add click event listeners to action buttons
            actionButtons.forEach(function(btn) {
                btn.addEventListener("click", handleButtonClick);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>