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
    $data .= "<p>id : '{$value["id"]}'</p>,
    <p>title : '{$value["subject"]}</p>',
    start : '{$value["date"]}'
    end : '{$value["end_date"]}'";
    
  }
}else {
  $data = "no courses";
}

echo "<pre>";
var_dump($data);
echo "</pre>";
die();

?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events : [{
            id: "a",
            title : "html course",
            start : "2024-05-01",
            end : "2024-05-15"
          }]
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>