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
			return Response::json(array(
				'message' => 'Adviser does not exist'),
			400);
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
				return Response::json(array(
					'message' => 'Invalid date'),
				400);
			}

			$min = $filter_date." 00:00:00";
			$max = $filter_date." 23:59:59";

			$unavailables = Unavailable::where('user_id', '=', $advisor_id)
				->whereBetween('start', array($min, $max))
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
		$unavailable = new Unavailable;
		$input = Input::all();

		if(!array_key_exists('start', $input)) {
			return Response::json(array(
				'message' => 'Missing start date'),
			400);
		}

		if(!array_key_exists('end', $input)) {
			return Response::json(array(
				'message' => 'Missing end date'),
			400);
		}

		$unavailable->user_id = $advisor_id;
		$unavailable->start = $input['start'];
		$unavailable->end = $input['end'];

		$unavailable->save();

		return Response::json($unavailable);
	}

	/**
	 * Update the specified appointment in storage.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */
	public function update($advisor_id, $unavailable_id) {
		$event = Unavailable::find($unavailable_id);
		$input = Input::all();

		if(isset($input['start'])) {
			$event->start = Carbon::parse($input['start'])->toDateTimeString();
		}

		if(isset($input['end'])) {
			$event->end = Carbon::parse($input['end'])->toDateTimeString();
		}

		$start = Carbon::parse($event->start);
		$end = Carbon::parse($event->end);

		// Check that start is before end
		if($start->gt($end)) {
			return Response::json(array(
				'message' => 'Start can not be after end'),
			400);
		}

		$event->save();

		return Response::json($event);
	}

	/**
	 * Disable the specified appointment in storage.
	 *
	 * @param  int  $appointment_id
	 * @return Response
	 *
	 */
	public function destroy($advisor_id, $unavailable_id) {
		Unavailable::destroy($unavailable_id);
	}

}