<?php

class Appointment extends Eloquent
{
	public function users()
	{
		$this->hasMany('User');
	}

	public function category()
	{
		$this->belongsTo('Category');
	}

}

?>