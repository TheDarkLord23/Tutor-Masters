<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

require_once "../db_connection.php";
require_once "../navbar_session.php";

 $data = "";
$sql = "SELECT * FROM `courses`";

$result = mysqli_query($connection,$sql);

if(mysqli_num_rows($result) > 0){
  $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

  foreach ($rows as  $value) {
    $data .= "id : '{$value["id"]}',
    title : '{$value["subject"]},
    start : '{$value["date"]}',
    end : '{$value["end_date"]}'";
    
  }
}else {
  $data = "no courses";
}



?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        let data = [];
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
        });
        calendar.render();
      });

    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/index.css">
  </head>
  <body>
      <div id='calendar'></div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>