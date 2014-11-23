<?php
class UserController extends BaseController {

	protected $layout = 'layouts.master';

	public function getLogin()
	{
		$data = array();
		$data['user'] = Auth::user();

		$this->layout->content = View::make('users.login',$data);
	}

	public function postLogin()
	{
		$email = Request::get('email');
		$password = Request::get('password');

		// Manually checking hash
		if (Auth::attempt(array('email' => $email, 'password' => $password))){
			return Redirect::to('/')->with('message', 'You are logged in.')->with('error', False);
		}else{
			return Redirect::to('login')->with('message', 'Invalid email and password.')->with('error', True);
		}

	}
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('login');
	}


	public function getRegister()
	{
		$data = array();
		$this->layout->content = View::make('users.register',$data);
	}


	public function postRegister()
	{
		$account_check = User::where('email', Input::get('email'))->first();

		$user = new User;
		if(is_null($account_check)){
			if (Input::get('password') != Input::get('password_rt')) {
				return Redirect::to('users/register')->with('message', "Passwords don't match")->with('error', True);
			}
			$user->Fname = Input::get('first_name');
			$user->Lname = Input::get('last_name');
			$user->Email = Input::get('email');
			$user->Phone = Input::get('phone');
			$user->password = Hash::make(Input::get('password'));
			$user->is_active = 1;
			$user->save();

			return Redirect::to('login')->with('message', 'Your account has been created.')->with('error', False);
		}else{
			return Redirect::to('register')->with('message', 'This Email Has Been Taken')->with('error', True);
		}
	}

}