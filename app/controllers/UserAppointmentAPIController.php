<?php

class UserAppointmentAPIController extends BaseController {

	/**
	 * Display a listing of Appointments under the Currently Logged User.
	 *
	 * @return Response
	 *
	 */

	public function index($user_id)
	{
		$appointments = Appointment::withUser();
		return Response::json($appointments);
	}

	/**
	 * Display the specified appointment.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */

	public function show($user_id, $appointment_id)
	{
		$appointment = Appointment::find($appointment_id);
		return Response::json($appointments);
	}

	/**
	 * Store a newly created appointment in storage.
	 *
	 * @return Response
	 *
	 */

	public function store($user_id)
	{
		$appointment = new Appointment;
		$input = Input::all();

		//Check Required
		if(!array_key_exists('category_id', $input)){
			return Response::json(array(
				'message' => 'Missing category_id'),
				400
			);
		}
		elseif(!array_key_exists('start_time', $input)){
			return Response::json(array(
				'message' => 'Missing start_time'),
				400
			);
		}
		elseif(!array_key_exists('end_time', $input)){
			return Response::json(array(
				'message' => 'Missing end_time'),
				400
			);
		}

		$appointment->save();
	}

	/**
	 * Update the specified appointment in storage.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */

	public function update($user_id, $appointment_id) {
		$appointment = Appointment::find($appointment_id);
		$input = Input::all();

		$appointment->save();
	}

	/**
	 * Disable the specified appointment in storage.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */

	public function destroy($user_id, $appointment_id) {
		$appointment = Appointment::find($appointment_id);
		$appointment->delete();
	}

}