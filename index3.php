<?php 
include 'assets/calendars.php';
include 'iCalClass2.php';
$casa= $_GET['casa'];
  $cal = new ics();
/* Getting events from isc file */



if($casa == 'FILE1'){
	echo json_encode($cal->totalDates(FILE1,$cal=true));
}elseif($casa == 'FILE2'){
echo json_encode($cal->totalDates(FILE2,$cal=true));
}
