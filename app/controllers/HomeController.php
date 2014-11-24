<?php

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
		$data['user'] = Auth::user();

		$this->layout->content = View::make('index',
			$data);
	}
	public function showAdvisorIndex()
	{
		$data['categories'] = Category::categories();
		$data['user'] = Auth::user();

		$this->layout->content = View::make('advisor.index',
			$data);
	}
}
