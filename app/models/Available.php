<?php

class Available extends Eloquent
{

	public function event()
	{
		$this->belongsTo('Event');
	}

	public function user()
	{
		$this->belongsTo('User');
	}
}

?>