<?php

class Category extends Eloquent 
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	public $timestamps = false;

	public static function categories() 
	{
		return Category::all();
	}

	public function users()
	{
		return $this->belongsToMany('User', 'advisor_categories');
	}

	public function appointments()
	{
		return $this->hasMany('Appointment');
	}

}

?>