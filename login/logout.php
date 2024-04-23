<?php

session_start();

if (isset($_GET["logout"])) {
    unset($_SESSION["admin"]);
    unset($_SESSION["user"]);
    unset($_SESSION["trainer"]);
    session_unset();
    session_destroy();

    header("Location: login.php");
}