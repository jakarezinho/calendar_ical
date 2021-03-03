<?php
include 'assets/calendars.php';
include 'iCalClass2.php';

/* Getting events from isc file */
function totalDates($file)
{
        $obj = new ics();
        $icsEvents = $obj->getIcsEventsAsArray($file);


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

                $data_events[] = array(
                        "title" => $eventName,
                        "start" => $startDate,
                        "end" => $endDate,
                );
        }

        return $data_events;
}



$calendar = array_merge(totalDates(FILE1), totalDates(FILE2));

echo json_encode($calendar);
