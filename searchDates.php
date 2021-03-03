<?php 
class searchDates
{
    private $openPeriod = [];
    private $interval;

   function __construct(array $openPeriods, $interval,$format=true)
    { 
        $this->interval = new DateInterval($interval);
        foreach ($openPeriods as $period) {
            $period = new DatePeriod(new DateTime($period[0]), $this->interval, new DateTime($period[1]), DatePeriod::EXCLUDE_START_DATE);
            foreach ($period as $interval) {
               $format ? $this->openPeriod[$interval->format('Y-m-d H:i:s')] = 1 : $this->openPeriod[$interval->format('Y-m-d')] = 1;
            }
        }
    }
    /**
     * 
     */

    public function getOverlap($start, $end, $format=true)
    {
        $periodToCheck = new DatePeriod(new DateTime($start), $this->interval, new DateTime($end));
        $intervalsWithinPeriod = [];
        foreach ($periodToCheck as $interval) {
          $format ?  $moment = $interval->format('Y-m-d H:i:s'): $moment = $interval->format('Y-m-d');
            $intervalsWithinPeriod[$moment] = isset($this->openPeriod[$moment]);
        }
        return array_filter($intervalsWithinPeriod);
    }

    

    
}