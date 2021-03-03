<?php
class extendIcal extends Ical
{

	/**
	 * 
	 * 
	 */

	 
	public function gate_date_bettween($file, $dateStart, $dateEnd)
	{
		$iCal = new iCal($file);
		$events = $iCal->eventsByDateBetween($dateStart, $dateEnd);
		$result = $this->jsonEvents($events);
		return $result;
	}

	/**
	 * 
	 * 
	 */

	public function jsonEvents($events)
	{
		$data_events = array();

		foreach ($events as $date => $events) {

			foreach ($events as $event) {

				$dateStart = date_format(date_create($event->dateStart), 'Y-m-d\TH:i:s');
				$dateEnd = date_format(date_create($event->dateEnd), 'Y-m-d\TH:i:s');

				$data_events[] = array(
					"title" => $event->title(),
					"start" => $dateStart,
					"end" =>  $dateEnd,
				);
			}
		}
		return $data_events;
	}

	/**
	 * 
	 */
	
	public function get_dispo($file, $file2, $dateStart, $dateEnd)
	{

		$data_events_1 = $this->gate_date_bettween($file, $dateStart, $dateEnd);
		$data_events_2 = $this->gate_date_bettween($file2, $dateStart, $dateEnd);

		if ($data_events_1 || $data_events_2 ) {
			return false;
		} else {
			return true;
		}
	}
}
