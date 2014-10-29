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

Route::get('/', 'HomeController@showWelcome');

Route::get('/polymer', 'HomeController@showPolymer');

Route::get('/login', 'UserController@getLogin');
Route::post('/login', 'UserController@postLogin');
Route::get('/register', 'UserController@getRegister');
Route::post('/register', 'UserController@postRegister');
Route::get('/logout', 'UserController@getLogout');


// Main API
Route::group(array('prefix' => 'api/v1' /*, 'before' => 'auth'*/), function()
{
	Route::resource('advisors.appointments', 'AdvisorAppointmentAPIController');
	Route::resource('advisors.available', 'AdvisorAvaiableAPIController');
	Route::resource('advisors', 'AdvisorAPIController');
	Route::resource('appointments', 'AppointmentAPIController');
	Route::resource('categories.advisors', 'CategoryAdvisorAPIController');
	Route::resource('categories', 'CategoryAPIController');
	Route::resource('users', 'UserAPIController');
});

