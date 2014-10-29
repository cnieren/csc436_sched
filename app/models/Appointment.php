<?php

class Appointment extends Eloquent
{
	public function event()
	{
		$this->belongsTo('Event');
	}

	public function category()
	{
		$this->belongsTo('Category');
	}

	public static function withUser($user_id){
		return User::find($user_id)->events;
	}
}

?>