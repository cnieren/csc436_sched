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
		$categories = Category::all()->lists('name', 'id');

		$this->layout->content = View::make('index', array('categories' => $categories));
	}

	public function showPolymer() 
	{
		return View::make('polymer-test');
	}

}
