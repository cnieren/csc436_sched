<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/login', 'UserController@getLogin');
Route::post('/login', 'UserController@postLogin');
Route::get('/register', 'UserController@getRegister');
Route::post('/register', 'UserController@postRegister');
Route::get('/logout', 'UserController@getLogout');

Route::group(array('before' => 'auth'), function()
{

	Route::get('/', 'HomeController@showIndex');
	Route::get('/appointments', 'HomeController@showAppointments');
	Route::get('/schedule', 'HomeController@showSchedule');

	// Main API
	Route::group(array('prefix' => 'api/v1'), function()
	{

		Route::resource('advisors.appointments', 'AdvisorAppointmentAPIController');
		Route::resource('advisors.unavailable', 'AdvisorUnavailableAPIController');
		Route::resource('advisors', 'AdvisorAPIController');
		Route::resource('appointments', 'AppointmentAPIController');
		Route::resource('categories.advisors', 'CategoryAdvisorAPIController');
		Route::resource('categories', 'CategoryAPIController');
		Route::resource('users', 'UserAPIController');
	});
});

