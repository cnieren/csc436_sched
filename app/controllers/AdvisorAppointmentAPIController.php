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

		$loggedInUserId = Auth::user()->id;

		if ($user->isAdvisor()) {
			$appointments = $user->appointments;

			foreach ($appointments as $key => $value) {
				$allUsers = $value->users;

				if ($allUsers[0]->id == $loggedInUserId || $allUsers[0]->id == $loggedInUserId) {
					$value->color = 'green';
					$value->title = $value->title . ' with you!';
				} else {
					$value->color = 'yellow';
				}								
			}

			return Response::json($appointments);
		}
		return "[]";
	}


}