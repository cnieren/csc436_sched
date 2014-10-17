<?php

class Available extends Eloquent 
{
	public function event() 
	{
		$this->belongsTo('Event');
	}

	public function category()
	{
		$this->belongsTo('Category');
	}
}

?>