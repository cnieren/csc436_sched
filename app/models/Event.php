<?php

class Event extends Eloquent 
{

	public function appointment() {
		return $this->hasOne('Appointment');
	}

	public function available() {
		return $this->hasOne('Available');
	}

?>
