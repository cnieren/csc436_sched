<?php



use Carbon\Carbon;

class AppointmentAPIController extends BaseController {

	/**
	 * Display a listing of Appointments under the Currently Logged User.
	 *
	 * @return Response
	 *
	 */

	public function index()
	{
		$appointments = Appointment::all();
		return Response::json($appointments);
	}

	/**
	 * Display the specified appointment.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */

	public function show($appointment_id)
	{
		$appointment = Appointment::find($appointment_id);
		return Response::json($appointment);
	}

	/**
	 * Store a newly created appointment in storage.
	 *
	 * Should have: category, advisor, studentId, startTime, endTime
	 *
	 * @return Response
	 *
	 */

	public function store()
	{
		$appointment = new Appointment;
		$input = Input::all();

		//Check Required
		if(!array_key_exists('category', $input)){
			return Response::json(array(
				'message' => 'Missing category'),
				400
			);
		}
		elseif(!array_key_exists('advisor', $input)){
			return Response::json(array(
				'message' => 'Missing advisor'),
				400
			);
		}
		elseif(!array_key_exists('start', $input)){
			return Response::json(array(
				'message' => 'Missing startTime'),
				400
			);
		}
		elseif(!array_key_exists('end', $input)){
			return Response::json(array(
				'message' => 'Missing endTime'),
				400
			);
		}
		elseif(!array_key_exists('studentId', $input)){
			return Response::json(array(
				'message' => 'Missing studentId'),
				400
			);
		}

		/*$dt_start = Carbon::now();
		$dt_end = Carbon::now();

		$dt_start->year(2004)->month(11)->day(3)->hour(9)->minute(15)->second(0);
		$dt_end->year(2004)->month(11)->day(3)->hour(9)->minute(30)->second(0);*/

		$appointment->category_id = $input['category'];
		$appointment->start = $input['start'];
		$appointment->end = $input['end'];
		$appointment->save();

		$user = User::find($input['studentId']);
		$std_appt = $user->appointments()->save($appointment);

		// DOES NOT CURRENTLY SET 'is_advising' correctly ... need to fix
		$advisor = User::find($input['advisor']);
		$adv_appt = $advisor->appointments()->save($appointment);
	}

	/**
	 * Update the specified appointment in storage.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */

	public function update($appointment_id) {
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

	public function destroy($appointment_id) {
		$appointment = Appointment::find($appointment_id);
		$appointment->delete();
	}

}