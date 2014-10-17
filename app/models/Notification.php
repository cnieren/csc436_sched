<?php

class Notification extends Eloquent 
{

	public function User() 
	{
		return $this->belongsTo('User');
	}
	
}

?>