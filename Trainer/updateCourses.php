<?php

require "../db_connection.php";
require "../login/file_upload.php";

session_start();

// validation start:

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

// validation end

// Get Data from table start:

$id = $_GET["id"];
$sql = "SELECT * FROM `courses` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

// Get Data from table end

// update start:

if (isset($_POST["submit"])) {
    $subject = $_POST["subject"];
    $name = $_POST["name"];
    $university = $_POST["university"];
    $roomNumb = $_POST["roomNumb"];
    $date = $_POST["date"];
    $end_date = $_POST["end_date"];
    $teacher = $_POST["teacher"];
    $language = $_POST["language"];
    $availability = $_POST["availability"];
    $units = $_POST["units"];
    $capacity = $_POST["capacity"];
    $duration = $_POST["duration"];
    $picture = fileUpload($_FILES["picture"]);

    $sql = "UPDATE `courses` SET `subject`='{$subject}',`university`='{$university}',`roomNumb`='{$roomNumb}',`date`='{$date}',`end_date`='{$end_date}',`teacher`='{$teacher}',`picture`='{$picture[0]}',`language`='{$language}',`duration`='{$duration}',`units`='{$units}',`capacity`='{$capacity}',`availability`='{$availability}',`name`='{$name}' WHERE id = $id";


    if (mysqli_query($connection, $sql)) {
        echo "<p>Course has been updated!</p>";
        header("refresh: 3; url=dashboardTrainer.php");
    } else {
        echo "<p>Something went wrong.Please try again later!</p>";
    }
}

// update end
mysqli_close($connection);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="<?php if ($results) {
                echo 'showPopup()';
              } ?>">

  <div id="successPopup" class="popup">
    <div class="popup-content">
      <div class="popup-bg">
        <img src="../Images/checkmark.png" alt="">
        <p>Success</p>
      </div>
      <div class="popup-text">
        <p>Congratulations, your course<br> has been successfully created</p>
        <a href="../Trainer/dashboardTrainer.php" class="continueBtn">Continue</a>
      </div>
    </div>
  </div>
  <div class="containerCRUD container mt-5">
    <div class="crudHeader">
      <h3 class="mb-4">Create a course:</h3>
    </div>
    <form id="multiStepForm" method="post" enctype="multipart/form-data">
      <!-- Step 1 -->
      <div class="step active">
        <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%; background-color: #099268; border-radius: 20px;"></div>
        </div>
        <div>
          <input class="input" type="text" value="<?=$row["subject"]?>" name="subject" required>
        </div>
        <div>
          <input class="input" type="text" value="<?=$row["university"]?>" name="university">
        </div>
        <div>
          <input class="input" type="text" value="<?=$row["roomNumb"]?>" name="roomNumb" required>
        </div>
        <button type="button" class="submitBtn" onclick="nextStep()">Next</button>
      </div>

      <!-- Step 2 -->
      <div class="step">
        <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 25%; background-color: #099268; border-radius: 20px;"></div>
        </div>
        <div>
          <input class="input" type="text" value="<?=$row["language"]?>" name="language" required>
        </div>
        <div>
          <label for="" style="margin: 10px 0 0 0; font-weight: 500;">Start Date & Time</label>
          <input class="input" type="datetime-local" value="<?=$row["date"]?>" name="date" style="margin: 0 0 10px 0;" required>
        </div>
        <div>
          <label for="" style="margin: 10px 0 0 0; font-weight: 500;">End Date & Time</label>
          <input class="input" type="datetime-local" value="<?=$row["end_date"]?>" name="end_date" style="margin: 0 0 10px 0;" required>
        </div>
        <div class="d-flex justify-content-between">
          <button type="button" class="submitBtn" onclick="prevStep()" style="width: 200px; background-color: #38D9A9;">Back</button>
          <button type="button" class="submitBtn" onclick="nextStep()" style="width: 200px;">Next</button>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step">
        <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 50%; background-color: #099268; border-radius: 20px;"></div>
        </div>
        <div>
          <input class="input" type="text" value="<?=$row["availability"]?>" name="availability" required>
        </div>
        <div>
          <input class="input" type="text" placeholder="Number of Units" name="units" required>
        </div>
        <div>
          <input class="input" type="text" placeholder="Duration" name="duration" required>
        </div>
        <div>
          <input class="input" type="text" placeholder="capacity" name="capacity" required>
        </div>
        <div class="d-flex justify-content-between">
          <button type="button" class="submitBtn" onclick="prevStep()" style="width: 200px; background-color: #38D9A9;">Back</button>
          <button type="button" class="submitBtn" onclick="nextStep()" style="width: 200px;">Next</button>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="step">
        <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%; background-color: #099268; border-radius: 20px;"></div>
        </div>
        <div>
          <input class="input" type="text" placeholder="Name" name="name">
        </div>
        <div>
          <input class="input" type="file" name="picture">
        </div>
        <div class="d-flex justify-content-between">
          <button type="button" class="submitBtn" onclick="prevStep()" style="width: 200px; background-color: #38D9A9;">Back</button>
          <button type="submit" name="submit" class="submitBtn" style="width: 200px;">Submit</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    function nextStep() {
      const currentStep = document.querySelector('.step.active');
      const nextStep = currentStep.nextElementSibling;

      if (nextStep) {
        currentStep.classList.remove('active');
        nextStep.classList.add('active');
      }
    }

    function prevStep() {
      const currentStep = document.querySelector('.step.active');
      const prevStep = currentStep.previousElementSibling;

      if (prevStep) {
        currentStep.classList.remove('active');
        prevStep.classList.add('active');
      }
    }
  </script>
  <script>
    function showPopup() {
      var popup = document.getElementById("successPopup");
      popup.classList.add("show");

      setTimeout(function() {
        window.location.href = "../Trainer/dashboardTrainer.php";
      }, 3000);
    }
  </script>

</body>

</html>

<form action="" method="post" enctype="multipart/form-data">


<input type="text" value="<?=$row["name"]?>" name="name">

<input type="text"  name="university" required>

<input type="text"  name="roomNumb" required>

<input type="datetime-local"  name="date" required>

<input type="datetime-local"  name="end_date" required>

<input type="text" value="<?=$row["teacher"]?>" name="teacher" required>

<input type="text"  name="language" required>

<input type="text"  name="availability" required>

<input type="text" value="<?=$row["units"]?>" name="units" required>

<input type="text" value="<?=$row["capacity"]?>" name="capacity" required>

<input type="text" value="<?=$row["duration"]?>" name="duration" required>

<input type="file" name="picture">

<input type="submit" name="submit">