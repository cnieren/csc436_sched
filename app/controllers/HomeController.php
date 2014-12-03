<?php

use Carbon\Carbon;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'layouts.master';

	public function showIndex()
	{
		$data['categories'] = Category::categories();
		$user = Auth::user();
		$data['user'] = $user;

		if (!$user->isAdvisor()) {
			$this->layout->content = View::make('index', $data);
		} else {
			return Redirect::to('/appointments');
			$this->layout->content = View::make('advisorIndex');
		}
	}
	public function showAppointments()
	{
		$user = Auth::user();
		$data['appointments'] = $user->appointments()->orderBy('start', 'ASC')->get();

		foreach ($data['appointments'] as $appointment) {
			$appointment->title = Category::find($appointment->category_id)->name;

			$appointment->start = Carbon::parse($appointment->start)->toDayDateTimeString();
			$appointment->end = Carbon::parse($appointment->end)->toDayDateTimeString();

			// This is the hackish...and slow!..way to find out who is really the adviser
			$allUsers = $appointment->users;
			if ($allUsers[0]->id == $user->id) {
				$appointment->advisor = $allUsers[1]->fname . ' ' . $allUsers[1]->lname;
			} else {
				$appointment->advisor = $allUsers[0]->fname . ' ' . $allUsers[0]->lname;
			}		
			
		}

		$this->layout->content = View::make('advisor.appointments',
			$data);
	}
	public function showSchedule()
	{
		$data['categories'] = Category::categories();
		$data['user'] = Auth::user();

		$this->layout->content = View::make('advisor.schedule',
			$data);
	}
}
