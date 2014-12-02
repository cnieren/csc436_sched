<?php

class Appointment extends Eloquent
{
	protected $defaults = array(
	   'title' => 'Appointment'
	);

	public function __construct(array $attributes = array())
	{
	    $this->setRawAttributes($this->defaults, true);
	    parent::__construct($attributes);
	}

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