<?php

class Role extends Eloquent {

	public function users()
	{
		return $this->belongsToMany('User', 'user_roles');
	}
}

?>