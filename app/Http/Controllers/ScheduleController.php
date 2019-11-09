<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\User;
use App\AvalibleTime;
use App\CalendarEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth','verified']);
	}

	public function index()
	{
		return view('schedule');
	}

	public function getSchedule()
	{
		$avalible_time = $this->getAvalibleTimeData();
		$calendar_events = $this->getCalendarEventsData();

		return response()->json(array_merge($calendar_events, $avalible_time));
	}

	public function getAvalibleTime()
	{
		$user = Auth::user();

		$data = AvalibleTime::where('user_id', $user->id)->get();
		return $data;
	}

	public function getAvalibleTimeData()
	{
		$user = Auth::user();
		$data_avalible_times = AvalibleTime::where('user_id', $user->id)->get();
		$avalible_time = array();

		foreach ($data_avalible_times as $data_avalible_time) {

			$daysOfWeek = array_map('intval', str_split($data_avalible_time['daysOfWeek'])) ;

			array_push($avalible_time, array(
				'title' => $data_avalible_time['title'],
				'groupId' => $data_avalible_time['groupId'],
				'daysOfWeek' => $daysOfWeek,
				'startTime' => $data_avalible_time['startTime'],
				'endTime' => $data_avalible_time['endTime'],
				'color' => $data_avalible_time['color'],
			));

			unset($daysOfWeek);
		}

		return $avalible_time;
	}

	public function getCalendarEventsData()
	{
		$user = Auth::user();
		$data_calendar_events = CalendarEvent::where('user_id', $user->id)->get();
		$calendar_events = array();

		foreach ($data_calendar_events as $data_calendar_event) {
			
			array_push($calendar_events, array(
				'title' => $data_calendar_event['title'],
				'date' => $data_calendar_event['date'],
				'allDay' => $data_calendar_event['allDay'],
			));
		}

		return $calendar_events;
	}

	public function editAvalibleTime(Request $request)
	{
		$user = Auth::user();

		$avalible_time = AvalibleTime::find($request->item_id);
		
		if ($avalible_time->user_id == $user->id) {

			$avalible_time->startTime = $request->data['startTime'];
			$avalible_time->endTime = $request->data['endTime'];
			
			$selectedDays = $request->data['selectedDays'];
			$days = array();
			
			for ($i=0; $i < count($selectedDays) ; $i++) { 
				if ($selectedDays[$i]['value'] == true) {
					array_push($days, $selectedDays[$i]['id']);
				}
			}
			
			$avalible_time->daysOfWeek = join('', $days);

			$avalible_time->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Editado correctamente',
			);
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'Error de autentacion',
			);
		}

		return response()->json($data);
	}

	public function deleteAvalibleTime(Request $request)
	{
		$user = Auth::user();
		$avalible_time = AvalibleTime::find($request->item_id);

		if ($avalible_time->user_id == $user->id) {
			$avalible_time->delete();
			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Borrado correctamente',
			);
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'Error de autentacion ',
			);
		}

		return response()->json($data);
	}

	public function addAvalibleTime(Request $request)
	{
		$user = Auth::user();

		$days = array();
		$selectedDays = $request->daysOfWeek;

		for ($i=0; $i < count($selectedDays); $i++) { 
			if ($selectedDays[$i]['value'] == true) {
				array_push($days, $selectedDays[$i]['id']);
			}
		}

		$avalible_time = new AvalibleTime();
		$avalible_time->startTime = $request->startTime;
		$avalible_time->endTime = $request->endTime;
		$avalible_time->daysOfWeek = join('', $days);
		$avalible_time->user_id = $user->id;
		$avalible_time->save();

		$data = array(
			'code' => 200,
			'status' => 'success',
			'message' => 'Horario creado exitosamente',
		);

		return response()->json($data);
	}
}
