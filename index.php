<?php
include 'assets/calendars.php';
include 'iCalClass.php';



$dateStart ='13-01-2020';
$dateEnd = '17-01-2020';




$iCal = new iCal(FILE1);
$events = $iCal->eventsByDate();

// or :
//$events = $iCal->eventsByDateBetween($dateStart, $dateEnd);
// or :
 //$events = $iCal->eventsByDateSince($dateStart);
// or :
// $events = $iCal->eventsByDateSince('today');$events


echo 'numero de eventos'.count($events)."\n";


foreach ($events as $date => $events)
{
	echo $date . "\n";
	echo '----------' . "\n";
	foreach ($events as $event)
	{
		echo '* ' . $event->title() . "\n";
		echo '* ' .  $event->dateStart .'-'.MyBetwenn ($dateStart,$event->dateStart,$event->dateEnd). "\n";
		echo '* ' .  $event->dateEnd.'-'. MyBetwenn ($dateEnd,$event->dateStart,$event->dateEnd)."\n". "\n";
		
		//echo MyBetwenn ($dateStart,$event->dateStart,$event->dateEnd) ."\n";
		//echo  MyBetwenn ($dateEnd,$event->dateStart,$event->dateEnd) ."\n";
	}
	echo "\n";
}



 
function MyBetwenn ($compareDate,$startDate,$endDate){


	//date_format($date, 'Y-m-d H:i:s'); format('Y-m-d\TH:i:s');

	$currentDate = date_format(date_create($compareDate), 'Y-m-d');

	
	  
	$start =  date_format(date_create($startDate), 'Y-m-d');
	$end = date_format(date_create($endDate), 'Y-m-d');
	   
	if (($currentDate >= $start) && ($currentDate < $end)){

		echo $currentDate."Current date is between two dates YES >>";  
	

	}
	
	else{
		echo "Current date is not between two dates mmmmmmmmmm";  
	}

}
/////////////

// Function to get all the dates in given range 
function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
      
    // Declare an empty array 
    $array = array(); 
      
    // Variable that store the date interval 
    // of period 1 day 
    $interval = new DateInterval('P1D'); 
  
    $realEnd = new DateTime($end); 
    $realEnd->add($interval); 
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
  
    // Use loop to store date into array 
    foreach($period as $date) {                  
        $array[] = $date->format($format);  
    } 
  
    // Return the array elements 
    return $array; 
} 
  
// Function call with passing the start date and end date 
$Date = getDatesFromRange('2020-01-22', '2020-01-23'); 
  
var_dump($Date);
/*
$start = new DateTime('2019-09-15 23:00:00');
$end = new DateTime('2019-09-16 10:00:00');

// create a period based on 1 hour intervals
$interval = new DateInterval('PT1H');
$period = new DatePeriod($start, $interval, $end, DatePeriod::EXCLUDE_START_DATE );
$hours = [];
foreach ($period as $date) {
    // foreach hour, check if it's between 8 & 20
    if($date->format('D') >= 20 || $date->format('D')  < 8) {
        $hours[] = $date->format('Y-m-d H:i');
    }
}
print_r($hours);

Class Roster {
    private $openPeriod = [];
    private $interval;

    public function __construct(array $openPeriods, $interval) {
        $this->interval = new DateInterval($interval);
        foreach($openPeriods as $period) {
            $period = new DatePeriod(new DateTime($period[0]), $this->interval, new DateTime($period[1]), DatePeriod::EXCLUDE_START_DATE );
            foreach($period as $interval) {
                $this->openPeriod[$interval->format('Y-m-d H:i:s')] = 1;
            }
        }
    }

    public function getOverlap($start, $end) {
        $periodToCheck = new DatePeriod(new DateTime($start), $this->interval, new DateTime($end));
        $intervalsWithinPeriod = [];
        foreach($periodToCheck as $interval) {
            $moment = $interval->format('Y-m-d H:i:s');
            $intervalsWithinPeriod[$moment] = isset($this->openPeriod[$moment]);
        }
        return array_filter($intervalsWithinPeriod);
    }
}

$opened = [
        ['2019-09-15 20:00:00', '2019-09-16 08:00:00'],
        ['2019-09-16 20:00:00', '2019-09-17 08:00:00'],
        ['2019-09-17 20:00:00', '2019-09-18 08:00:00'],
        ['2019-09-18 20:00:00', '2019-09-19 08:00:00']
];

// use PT1H  /  PT1M  /  PT1S  here for hours -> seconds
$roster = new Roster($opened, 'PT1H');
$intervals = $roster->getOverlap('2019-09-15 23:00:00', '2019-09-18 23:00:00');
print_r($intervals);
 

$currentDate = "2020-01-08 00:00:00";
$currentDate = date('Y-m-d', strtotime($currentDate));
   var_dump($currentDate);
$startDate = date('Y-m-d', strtotime("01-01-2020"));
$endDate = date('Y-m-d', strtotime("01-10-2020"));
   
if (($currentDate >= $startDate) && ($currentDate <= $endDate)){
    echo "Current date is between two dates fff";
}else{
    echo "Current date is not between two dates ffff";  
}

/////
 public function MyBetwenn($compareDateStart, $compareDateEnd, $startDate, $endDate)
    {
    
    
        //date_format($date, 'Y-m-d H:i:s'); format('Y-m-d\TH:i:s');
    
        $currentDateStart = date_format(date_create($compareDateStart), 'Y-m-d');
        $currentDateEnd = date_format(date_create($compareDateEnd), 'Y-m-d');
    
    
    
        $start =  date_format(date_create($startDate), 'Y-m-d');
        $end = date_format(date_create($endDate), 'Y-m-d');
    
        if (($currentDateStart >= $start) && ($currentDateStart <= $end)) {
    
    
            return "No avaible Date" . $currentDateStart;
        }
        if (($currentDateEnd >= $start) && ($currentDateEnd <= $end)) {
    
    
            return "No avaible date:" . $currentDateEnd;
        } else {
            return 'Avaible date  Start'.$currentDateStart.'End'.$currentDateEnd;
        }
    }

*/



?>

