<?php

class Unavailable extends Eloquent
{
	public $timestamps = false;

	protected $defaults = array(
	   'title' => 'Unavailable',
	   'editable' => false
	);

	public function __construct(array $attributes = array())
	{
	    $this->setRawAttributes($this->defaults, true);
	    parent::__construct($attributes);
	}	

	public function getEditableAttribute($editable) {
		return (bool) $editable;
	}

	public function user()
	{
		$this->belongsTo('User');
	}
}

?>