<?php

class Available extends Eloquent
{
	public $timestamps = false;

	public function user()
	{
		$this->belongsTo('User');
	}
}

?>