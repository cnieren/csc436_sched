<?php

class Unavailable extends Eloquent
{
	public $timestamps = false;

	public function user()
	{
		$this->belongsTo('User');
	}
}

?>