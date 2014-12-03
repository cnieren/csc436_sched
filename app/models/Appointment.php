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
		return $this->belongsToMany('User','appointment_users','appointment_id','user_id');

	}

	public function category()
	{
		return $this->belongsTo('Category');
	}

}

?>