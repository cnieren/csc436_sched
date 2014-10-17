<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('salt', 'salted_hash');

	public function roles() 
	{
		return $this->belongsToMany('Role', 'user_roles');
	}

	public function categories()
	{
		return $this->belongsToMany('Category', 'advisor_categories');
	}

	public function notifications()
	{
		return $this->hasMany('Notification');
	}

	public function availables()
	{
		return $this->hasMany('Available');
	}
}
