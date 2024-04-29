<?php 
function build_calendar($month,$year){

    // create an array of contraining names of all days in a week.
    $daysOfWeek = array('Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    // Get the first day of the month that is in the argument of this function
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // Get the number of days in a month
    $numberDays = date('t',$firstDayOfMonth);

    // Getting some information
    $dateComponents = getdate($firstDayOfMonth);

    // Get the name of this month
    $monthName = $dateComponents['month'];

    // Get the index value 0-6 of the first day of this month
    $dayOfWeek = $dateComponents['wday'];

    // Get the current date.
    $dateToday = date('Y-m-d');

    // Now creating the HTML table
    $calendar = "<table class='table table-bordered'>";
    $calendar.= "<center><h2>$monthName $year</h2>";

    $calendar.= "<tr>";

    // creatin the calendar headers
    foreach($daysOfWeek as $day){
        $calendar.="<th class='header'>$day</th>";
    }


    $calendar.= "</tr><tr>";

    // The variable $dayOfWeekt will make sure that there must be only 7 columns on our table
    if($dayOfWeek > 0){
        for($k=0; $k<$dayOfWeek;$k++){
            $calendar.="<td></td>";
        }
    }

    // initating the day counter 
    $currentDay = 1;

    // getting the month number 
    $month = str_pad($month,2,"0", STR_PAD_LEFT);

    while($currentDay <=$numberDays){

        // if seventh column(saturday) reached, start a new row
        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar.="</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay,2,"0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        if($dateToday==$date){
            $calendar.= "<td><h4>$currentDay</h4>";
        }else{
            $calendar.="<td><h4>$currentDay</h4>";
        }

        $calendar.= "</td>";

        // Incrementing the counters
        $currentDay++;
        $dayOfWeek++;
    }

    // Completing the row wof the last week in month, if neccessary.
    if($dayOfWeek != 7){
        $remainingDays = 7-$dayOfWeek;
        for($i=0; $i<$remainingDays;$i++){
            $calendar.= "<td></td>";
        }
    }

    $calendar.= "</tr>";
    $calendar.= "</table>";

    echo $calendar;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/calendar.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                $month = $dateComponents['mon'];
                $year = $dateComponents['year'];
                echo build_calendar($month, $year);
                ?>
            </div>
        </div>
    </div>
</body>
</html>