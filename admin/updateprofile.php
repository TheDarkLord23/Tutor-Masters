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
require_once "../login/file_upload.php";

$session = $_SESSION["admin"];
$goBack = "";

$sql = "SELECT * FROM users WHERE id = {$session}";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);


if (isset($_POST["update"])) {
    $firstName = $_POST["firstName"];
    $secondName = $_POST["secondName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $address = $_POST["address"];
    $phoneNumber = $_POST["phoneNumber"];
    // $picture = fileUpload($_FILES["picture"]);


    $pictureArray = fileUpload($_FILES['picture']);


    // if ($pictureArray->error == 4) {
    $update = "UPDATE `users` SET `firstName`='{$firstName}',`secondName`='{$secondName}',`email`='{$email}',`password`='{$password}',`address`='{$address}',`phoneNumber`='{$phoneNumber}',`picture`='{$pictureArray[0]}' WHERE id = {$session}";
    // } else {
    //     if ($row["picture"] != "../Images/defaultPic.jpg") {
    //         unlink("../images{$row["picture"]}");
    //     }
    //     $update = "UPDATE `users` SET `firstName`='{$firstName}',`secondName`='{$secondName}',`email`='{$email}',`address`='{$address}',`phoneNumber`='{$phoneNumber}', `picture`='{$pictureArray[0]}' WHERE id = {$session}";
    // }

    if (mysqli_query($connection, $sql)) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray != 0) ? $pictureArray : '';
        header("refresh:3;url=dashboardAdmin.php?id={$session}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connection->error;
        // $uploadError = ($pictureArray != 0) ? $pictureArray['ErrorMessage'] : '';
        header("refresh:3;url=updateprofile.php?id={$session}");
    }


    $result = mysqli_query($connection, $update);

    header("Location: dashboardAdmin.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update your Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/CRUD.css">
</head>

<body>
    <div class="containerCRUD container mt-5">
        <div class="crudHeader mb-3">
            <h3>Update Profile</h3>
        </div>
        <?php if (!empty($message)) : ?>
            <!-- ' updateError & massage noch bearbeiten' -->
            <div class="alert alert-<?= $class; ?>" role="alert">
                <p><?= $message ?></p>
                <a href='indexUser.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="step active">
                <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%; background-color: #099268; border-radius: 20px;"></div>
                </div>
                <label for="firstName">First Name</label>
                <input class="input" type="text" name="firstName" placeholder="Change first name" value="<?= isset($row["firstName"]) ? $row["firstName"] : '' ?>">
                <label for="secondName">Last Name</label>
                <input class="input" type="text" name="secondName" placeholder="Change last name" value="<?= isset($row["secondName"]) ? $row["secondName"] : '' ?>">
                <label for="email">E-mail</label>
                <input class="input" type="text" name="email" placeholder="Change email" value="<?= isset($row["email"]) ? $row["email"] : '' ?>">
                <label for="password">Password</label>
                <input class="input" type="text" name="password" placeholder="Change password">
                <button type="button" class="submitBtn" onclick="nextStep()">Next</button>
            </div>

            <div class="step">
                <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%; background-color: #099268; border-radius: 20px;"></div>
                </div>
                <label for="phoneNumber">Phone Number</label>
                <input class="input" type="text" name="phoneNumber" placeholder="Change phone Number" value="<?= isset($row["phoneNumber"]) ? $row["phoneNumber"] : '' ?>">
                <label for="address">Address</label>
                <input class="input" type="text" name="address" placeholder="Change address" value="<?= isset($row["address"]) ? $row["address"] : '' ?>"></input>
                <br><br>
                <label for="picture">Change your profile picture</label>
                <input class="input" type="file" id="picture" name="picture">
                <br>
                <br>
                <div class="d-flex justify-content-between">
                    <button type="button" class="submitBtn" onclick="prevStep()" style="width: 200px; background-color: #38D9A9;">Back</button>
                    <button type="submit" class="submitBtn" value="Update" name="update" style="width: 200px;">Update</button>
                </div>
            </div>
        </form>


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
</body>

</html>