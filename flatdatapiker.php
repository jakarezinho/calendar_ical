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
    $newarray =[];

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

            "from" => $startDate,
            "to" => $endDate,
        );
    }

//return $data_events;




    $today = date('Y-m-d');
    foreach ($data_events as $item) {
        if ($item['from'] > $today && $item['to'] < $today) {
            $newarray[] = $item;
        }
    }
 return $newarray;

}



$calendar = array_merge(totalDates(FILE1), totalDates(FILE2));

var_dump($calendar);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
</head>

<body>
    <input class="flatpickr flatpickr-input active" id="start" type="date" placeholder="Select Date.." readonly="readonly">
    <input class="flatpickr flatpickr-input active" id="end" type="date" placeholder="Select Date.." readonly="readonly">



    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        let end = document.querySelector("#start");
        console.log(end);

        let s = <?php echo json_encode($calendar); ?>

        avCal('#start', s);

        function avCal(cal, dates) {
            flatpickr(cal, {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: dates,


            });


        }

        flatpickr("#end", {

            //mode: "range",
            //minDate: "today",
            dateFormat: "Y-m-d",
            disable: [{
                    from: "2020-01-14",
                    to: "2020-01-15"
                },
                {
                    from: "2025-09-01",
                    to: "2025-12-01"
                }
            ]

        });
    </script>
</body>

</html>