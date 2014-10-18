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
	protected $hidden = array('salt','salted_hash');

	public function getAuthPassword()
	{
		return $this->attributes['salted_hash'];
	}

	public function isAdvisor(){
		return ($this->role_id == 1);
	}

	public static function advisors(){
		return static::where('role_id','1')->get();
	}

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

	public function attendees() {
		return $this->hasMany('Attendee');
	}

}
