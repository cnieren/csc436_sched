<?php

class Unavailable extends Eloquent
{
	public $timestamps = false;

	protected $defaults = array(
	   'title' => 'Unavailable',
	);

	public function __construct(array $attributes = array())
	{
	    $this->setRawAttributes($this->defaults, true);
	    parent::__construct($attributes);
	}	

	public function user()
	{
		$this->belongsTo('User');
	}
}

?>