<?php
class ics
{
    /* Function is to get all the contents from ics and explode all the datas according to the events and its sections */
    public function getIcsEventsAsArray($file)
    {
        $icalString = file_get_contents($file);
        $icsDates = array();
        /* Explode the ICs Data to get datas as array according to string ‘BEGIN:’ */
        $icsData = explode("BEGIN:", $icalString);
        /* Iterating the icsData value to make all the start end dates as sub array */
        foreach ($icsData as $key => $value) {
            $icsDatesMeta[$key] = explode("\n", $value);
        }
        /* Itearting the Ics Meta Value */
        foreach ($icsDatesMeta as $key => $value) {
            foreach ($value as $subKey => $subValue) {
                /* to get ics events in proper order */
                $icsDates = $this->getICSDates($key, $subKey, $subValue, $icsDates);
            }
        }
        return $icsDates;
    }

    /* funcion is to avaid the elements wich is not having the proper start, end  and summary informations */
    public function getICSDates($key, $subKey, $subValue, $icsDates)
    {
        if ($key != 0 && $subKey == 0) {
            $icsDates[$key]["BEGIN"] = $subValue;
        } else {
            $subValueArr = explode(":", $subValue, 2);
            if (isset($subValueArr[1])) {
                $icsDates[$key][$subValueArr[0]] = $subValueArr[1];
            }
        }
        return $icsDates;
    }

    /**
     * 
     */

    public function totalDates($file, $cal = false)
    {

        $icsEvents = $this->getIcsEventsAsArray($file);

        //echo json_encode($icsEvents, JSON_FORCE_OBJECT);
        $data_events = array();

        /* Here we are getting the timezone to get the event dates according to gio location */
        $timeZone = trim($icsEvents[1]['X-WR-TIMEZONE']);
        unset($icsEvents[1]);
        foreach ($icsEvents as $icsEvent) {
            /* Getting start date and time */
            $start = isset($icsEvent['DTSTART;VALUE=DATE']) ? $icsEvent['DTSTART;VALUE=DATE'] : $icsEvent['DTSTART'];
            /* Converting to datetime and apply the timezone to get proper date time */
            $startDt = new DateTime($start);
            //$startDt->setTimeZone ( new DateTimezone ( $timeZone ) );
            $startDate = $startDt->format('Y-m-d\TH:i:s');
            /* Getting end date with time */
            $end = isset($icsEvent['DTEND;VALUE=DATE']) ? $icsEvent['DTEND;VALUE=DATE'] : $icsEvent['DTEND'];
            $endDt = new DateTime($end);
            $endDate = $endDt->format('Y-m-d\TH:i:s');
            /* Getting the name of event */
            $eventName = $icsEvent['SUMMARY'];
            $eventDescription = $icsEvent['DESCRIPTION'];

            if ($cal) {
                $data_events[] = array(
                    "title" => $eventName,
                    "start" => $startDate,
                    "end" => $endDate,
                );
            } else {
                $data_events[] = array(
                    $startDate,
                    $endDate,
                );
            }
        }

        return $data_events;
    }
}
