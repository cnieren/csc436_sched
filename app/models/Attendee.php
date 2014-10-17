<?php

class Attendee extends Eloquent 
{

	public function appointment()
	{
		return $this->belongsTo('Appointment', 'event_id', 'event_id');
	}

	public function user() {
		return $this->belongsTo('User');
	}

}

?>