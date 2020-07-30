<?php

namespace Drupal\events_status;

class DateCalculator {

	/*
	*	¸Function gets current dates calculates the difference between today and event date and returns respond.  
	*/
	public function daysUntilEventStarts($event_date) {

		$now = date_create(date("Y-m-d", strtotime(date("Y-m-d"))));
		$difference = round(date_diff($now, $event_date)->format("%R%a"));

		if ($difference == 0){
			return "<p>This event is happening today</p>";
		} else if ($difference < 0) {
			return "<p> This event already passed.</h4><p>";
		} else if ($difference > 0) {
			return "<p>" . $difference . " days left until event starts</p>";
		}
	}
}