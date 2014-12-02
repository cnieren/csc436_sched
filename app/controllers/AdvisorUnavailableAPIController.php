<?php

use Carbon\Carbon;

class AdvisorUnavailableAPIController extends BaseController {

	/**
	 * Display a listing of Appointments under the Currently Logged User.
	 *
	 * @return Response
	 *
	 */

	public function index($advisor_id)
	{
		$unavailables = User::find($advisor_id)->unavailables;
		return Response::json($unavailables);
	}

	/**
	 * Returns either all unavailables for the passed in advisor_id
	 * OR will return only unavailables for the passed in advisor_id and filter_date
	 *
	 * @param  int  $advisor_id, string filter_date
	 * @return Response
	 *
	 * api/v1/advisors/2/available/*
	 * api/v1/advisors/2/available/2014-11-17
	 */

	public function show($advisor_id, $filter_date)
	{
		$unavailables = null;
		$advisor = User::find($advisor_id);

		// Make sure advisor exists
		if ($advisor== null) {
			return '[{"error": "Advisor does not exist"]}';
		}

		if ($filter_date == "*") {
			// Return all availables for the passed in advisor id
			$unavailables = $advisor->unavailables;
		} else {
			// Return only availables that fall on the passed in
			// filter date

			// Make sure the passed in date is valid
			try {
				$dt = Carbon::now();
				$dt->createFromFormat('Y-m-d', $filter_date);
			} catch (InvalidArgumentException $e) {
				return '[{"error": "Invalid date"]}';
			}

			$min = $filter_date." 00:00:00";
			$max = $filter_date." 23:59:59";

			$unavailables = Unavailable::where('user_id', '=', $advisor_id)
				->whereBetween('start_time', array($min, $max))
				->get();
		}

		return $unavailables;
	}

	/**
	 * Store a newly created availability in storage.
	 *
	 * @return Response
	 *
	 */

	public function store($advisor_id)
	{
		$newUnavailable = new Unavailable;
		$newUnavailable->user_id = $advisor_id;

		$dt_start = Carbon::now();
		$dt_end = Carbon::now();

		$dt_start->year(2004)->month(11)->day(3)->hour(9)->minute(15)->second(0);
		$dt_end->year(2004)->month(11)->day(3)->hour(9)->minute(30)->second(0);

		$newUnavailable->start_time = $dt_start;
		$newUnavailable->start_time = $dt_end;

		$newUnavailable->save();
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