<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// get database connection
include 'iCalClass2.php';
include 'searchDates.php';
include 'assets/calendars.php';

$dispo = NULL;

$data = json_decode(file_get_contents("php://input"));
$casa = $data->casa;
$file = $data->file;

$dateStart = $data->entrada;
$dateEnd = $data->saida;

$obj = new ics();
$opened = array_merge($obj->totalDates($file));
$roster = new searchDates($opened, 'PT1H');
$disp = $roster->getOverlap($dateStart, $dateEnd);

if (!$disp) {

  http_response_code(200);

  // casa dispo
  echo json_encode(
    [
      "casa" => $casa,
      "statu" => "disponivel",
      "entrada" => date_format(date_create($dateStart), 'd-M-Y'),
      "saida" => date_format(date_create($dateEnd), 'd-M-Y'),
      "message" => "Alojamento: $casa DISPONIVEL para ".date_format(date_create($dateStart), 'd-M-Y')."/".date_format(date_create($dateEnd), 'd-M-Y'),
      
    ]
  );
} else {
  // set response code - 404 Not found
  http_response_code(200);

  // tell the user no products found
  echo json_encode(
    [
      "casa" => $casa,
      "statu" => "ocupado",
      "entrada" => date_format(date_create($dateStart), 'd-M-Y'),
      "saida" => date_format(date_create($dateEnd), 'd-M-Y'),
       "message" => "Alojamento: $casa OCUPADA para ".date_format(date_create($dateStart), 'd-M-Y')."/".date_format(date_create($dateEnd), 'd-M-Y')
    ]

  );
}
