<?php

class AdvisorAPIController extends BaseController {

	/**
	 * Display a listing of all Advisors.
	 *
	 * @return Response
	 */

	public function index()
	{
		$users = Users::advisors();
		return Response::json($users);
	}

	/**
	 * Display the specified Advisor.
	 *
	 * @param  int $advisor_id
	 * @return Response
	 */

	public function show($user_id)
	{
		$user = User::find($user_id);
		if ($user->isAdvisor()) {
			# code...
		}
		return Response::json($user);
	}


}