<?php

class Category extends Eloquent 
{
	public $timestamps = false;

	public function users()
	{
		return $this->belongsToMany('User', 'advisor_categories');
	}

	public function appointments()
	{
		return $this->hasMany('Appointment');
	}

}

?>