<?php

class AdvisorAppointmentAPIController extends BaseController {

	/**
	 * Display a listing of Appointments under the Currently Logged User.
	 *
	 * @return Response
	 *
	 */

	public function index($user_id)
	{
		$user = User::find($user_id);
		if ($user->isAdvisor()) {
			return Response::json($user->appointments);
		}
		return "[]";
	}


}