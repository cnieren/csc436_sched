<?php

class Event extends Eloquent
{

	public function appointment() {
		return $this->hasOne('Appointment');
	}

	public function available() {
		return $this->hasOne('Available');
	}

	public function attendees()
	{
		return $this->belongsToMany('User', 'attendees', 'event_id', 'user_id');
	}
}