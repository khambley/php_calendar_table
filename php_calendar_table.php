<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>11 - Calendar Table</title>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        width: 750px;
        height: 500px;
        margin: 15px auto;
    }
    .main-header {
        margin: 0 auto;
        text-align: center;
    }
    .calendar {
        margin: 0 auto;
        width: 600px;
        height: 600px;
        padding: 5px;
        border: 1px solid #0094ff;
        table-layout: fixed;
    }
    .header {
        text-align: right;
        vertical-align: bottom;
        height: 20px;
        text-align: center;
    }
    td {
        text-align: right;
        vertical-align: top;
        border: 1px solid #0094ff;
    }
    td.container > div { width: 100%; height: 100%; overflow:hidden; }
    td.container { height: 110px; }
    caption {
        padding-bottom: 10px;
        font-weight: bold;
    }
    .red {
        background-color: #00ff90;
        font-size: small;
        color: #ff0000;
    }
    .text {
        
    }
</style>
</head>

<body>
<?php
function calendar_table($month, $bday, $year, $dateArray) {

	//An array containing days of the week.
	$daysofweek = array('Sun','Mon','Tue','Wed','Thur','Fri','Sat');
	
	//Find the first day of the given month.
	$firstDayofMonth = mktime(0,0,0,$month,1,$year);
	
	//Count number of days in the given month.
	$numberofDays = date('t',$firstDayofMonth);
	
	//Get the date array of the given month
	$dateArray = getdate($firstDayofMonth);
	
	//Get the name of the given month
	$monthName = $dateArray['month'];
	
	//Get the index of the first day of the given month.
	$dayofWeek = $dateArray['wday'];
	
	//Create the HTML table tag
	$calendar = "<table class='calendar'>";
	$calendar .= "<caption>$monthName $year</caption>";
	$calendar .= "<tr>";
	
	//Create the HTML table header
	foreach($daysofweek as $day) {
		$calendar .= "<th class='header'>$day</th>";
	}
	
	//Create the HTML table body columns and rows
	//Create the day counter
	$currentDay = 1;
	$calendar .= "</tr><tr>";
	
	if ($dayofWeek > 0) {
		$calendar .= "<td colspan='$dayofWeek'>&nbsp;</td>";
	}
	
	
	while ($currentDay <= $numberofDays) {
		
		//if End of row - 7th column, Start a new row.
		
		if ($dayofWeek == 7) {
			$dayofWeek = 0;
			$calendar .= "</tr><tr>";
		} 
        		$currentDayRel = $currentDay;
						
            $date = "$year-$month-$currentDayRel";
            
            if ($currentDay == $bday) {
                $calendar .= "<td class='day red container' rel='$date'><div>$currentDay<br />Happy Birthday!</div></td>";
                
            } else {
                $calendar .= "<td class='day' rel='$date'>$currentDay</td>";
            }
        
		
		//Increment Counters - Break out of loop
		$currentDay++;
		$dayofWeek++;
        
	} // End of while loop
	
	//Complete last row in month if needed
	if ($dayofWeek != 7) {
			$remainingDays = 7 - $dayofWeek;
			$calendar .= "<td colspan='remainingDays'>&nbsp;</td>";
		}
	
	$calendar .= "</tr>";
	$calendar .= "</table";
	
	return $calendar;
	
}
?>
<div class="container">
    <div class="main-header">
        <h1>Birthday Month Calendar</h1><br />
    </div>
    <form name="birthday" method="GET">
        Select your birthday:<br /><br />Month:
        <select name="month">
            <option value=""></option>
            <option value="1">Jan</option>
            <option value="2">Feb</option>
            <option value="3">Mar</option>
            <option value="4">Apr</option>
            <option value="5">May</option>
            <option value="6">Jun</option>
            <option value="7">Jul</option>
            <option value="8">Aug</option>
            <option value="9">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>&nbsp;&nbsp;&nbsp;
        Day: <select name="day">
            <option value=""></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="Submit" />
    </form><br />
<?php

$dateArray = getdate();
if (isset($_GET['month']) && isset($_GET['day'])) {
	$month = $_GET['month'];
	$bday = $_GET['day'];
}

$year = $dateArray['year'];
if (isset($month) && isset($bday)) {
    echo calendar_table($month, $bday, $year, $dateArray);
}

?>
</div>
</body>
</html>