<?php
header("Access-Control-Allow-Origin: *");
//*header("Content-Type: application/json; charset=UTF-8");

include 'assets/calendars.php';
include 'iCalClass2.php';
include 'searchDates.php';

$obj = new ics();
$data = json_decode(file_get_contents("php://input"));
$casa = $data->calendario;
$opened = array_merge($obj->totalDates($casa));


 $cal = new ics();
////////////////////////////////////////

function calendJs($datas){
	$dt=[];
	foreach ($datas as $key => $value) {
		$dt[]=$key;   

	}
	return $dt;

}


 $today = date('Y-m-d H:i:s');

$date_fin = new DateTime($today);
$interval = new DateInterval('P2M');
$fin = $date_fin->add($interval)->format('Y-m-d H:i:s');


// use PT1H  /  PT1M  /  PT1S  here for hours -> seconds
$roster = new searchDates($opened, 'PT1H',false);
$intervals = $roster->getOverlap($today, $fin,false);


echo json_encode(calendJs($intervals));
 

