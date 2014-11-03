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
		$roles = $this->roles;
		foreach ($roles as $role) {
			if ($role->id == 2) {
				return true;
			}
		}
		return false;
	}

	public static function advisors(){
		return Role::find(2)->users;
	}

	public function roles()
	{
		return $this->belongsToMany('Role', 'user_roles', 'user_id', 'role_id');
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

	public function appointments() {
		return $this->belongsToMany('Appointment', 'appointment_users', 'user_id', 'appointment_id');
	}

}
