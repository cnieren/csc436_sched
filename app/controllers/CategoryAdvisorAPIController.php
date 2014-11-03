<?php

class CategoryAdvisorAPIController extends BaseController {

	/**
	 * Display a listing of Appointments under the Currently Logged User.
	 *
	 * @return Response
	 *
	 */

	public function index()
	{
	}

	/**
	 * Returns all advisors that belong to the
	 * given category ID
	 *
	 * @param  int  $category_id
	 * @return Response
	 *
	 */

	public function show($cat_id)
	{
		$advisors = Category::find($cat_id)->users;

		return Response::json($advisors);
	}

	/**
	 * Store a newly created appointment in storage.
	 *
	 * @return Response
	 *
	 */

	public function store()
	{

	}

	/**
	 * Update the specified appointment in storage.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */

	public function update($appointment_id) {

	}

	/**
	 * Disable the specified appointment in storage.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */

	public function destroy($appointment_id) {

	}

}