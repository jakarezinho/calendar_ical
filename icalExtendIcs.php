<?php

class icalExtendIcs extends ics
{


    /**
     * 
     * 
     */
    public function getDispo($file1, $file2, $startDate, $endDate)
    {

        $cal1 = $this->MyBetwennDates($file1, $startDate, $endDate);
        $cal2 = $this->MyBetwennDates($file2, $startDate, $endDate);

        if ($cal1 && $cal2) {
            return true;
        } else {
            return false;
        }

        /*
        // set response code - 200 ok
    http_response_code(200);
      // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user
    echo json_encode(array("message" => "Product was updated."));
}*/
    }


    /**
     * 
     * 
     */

    public function MyBetwennDates($file, $startDate, $endDate)
    {

        $icsEvents = $this->getIcsEventsAsArray($file);



        /* Here we are getting the timezone to get the event dates according to gio location */
        $timeZone = trim($icsEvents[1]['X-WR-TIMEZONE']);
        unset($icsEvents[1]);

        foreach ($icsEvents as $icsEvent) {
            /* Getting start date and time */
            $start = isset($icsEvent['DTSTART;VALUE=DATE']) ? $icsEvent['DTSTART;VALUE=DATE'] : $icsEvent['DTSTART'];
            /* Converting to datetime and apply the timezone to get proper date time */
            $startDt = new DateTime($start);
            //$startDt->setTimeZone ( new DateTimezone ( $timeZone ) );
            $startIcal = $startDt->format('Y-m-d');
            /* Getting end date with time */
            $end = isset($icsEvent['DTEND;VALUE=DATE']) ? $icsEvent['DTEND;VALUE=DATE'] : $icsEvent['DTEND'];
            $endDt = new DateTime($end);
            $endIcal = $endDt->format('Y-m-d');

            $result = $this->MyBetwenn($startDate, $endDate, $startIcal, $endIcal);
            return $result;
        }
    }
    /**
     * 
     * 
     */

    public function MyBetwenn($compareDateStart, $compareDateEnd, $startDate, $endDate)
    {


        //date_format($date, 'Y-m-d H:i:s'); format('Y-m-d\TH:i:s');

        $currentDateStart = date_format(date_create($compareDateStart), 'Y-m-d');
        $currentDateEnd = date_format(date_create($compareDateEnd), 'Y-m-d');



        $start =  date_format(date_create($startDate), 'Y-m-d');
        $end = date_format(date_create($endDate), 'Y-m-d');

        if (($currentDateStart >= $start) && ($currentDateStart < $end)) {


            return false;
        }
        if (($currentDateEnd >= $start) && ($currentDateEnd < $end)) {


            return false;
        } else {
            return true;
        }
    }
}
