<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\User;
use App\AvalibleTime;
use App\CalendarEvent;
use App\Meeting;
use Carbon\Carbon;
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

	public function getAvalibleTimeByUserId($uuid)
	{
		$user = User::where('uuid', $uuid)->first();
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
		$data_calendar_events = CalendarEvent::where('user_id', $user->id)
											->orWhere('other_user_id', $user->id)
											->get();
		$calendar_events = array();

		foreach ($data_calendar_events as $data_calendar_event) {
			if ($data_calendar_event['queue'] == 0) {
				array_push($calendar_events, array(
					'title' => $data_calendar_event['title'],
					'date' => $data_calendar_event['date'],
					'allDay' => $data_calendar_event['allDay'],
				));				
			}
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

	public function createCalendarEvent(Request $request)
	{
		$user = Auth::user();
		
		if ($user->uuid == $request->user_uuid) {
			$avalible_time = AvalibleTime::find($request->avalible_time_id);
			
			$other_user = User::find($avalible_time->user_id);

			// Obtener fecha
			$date = $request->day['year'] . "-" . ($request->day['month'] + 1) . "-" . $request->day['date'];
			$time = $request->hour['hour'];

			$datetime = $date . " " . $time;
			
			// Crea evento

			$calendar_event = new CalendarEvent();
			$calendar_event->title = "Reunion: " . $user->commercial_name . " - " . $other_user->commercial_name;
			$calendar_event->date = $datetime;
			$calendar_event->user_id = $user->id;
			$calendar_event->other_user_id = $other_user->id;
			$calendar_event->save();
			
			// Cambiar estado del meeting
			$meeting = Meeting::find($request->meeting_id);
			$meeting->state_id = 4;
			$meeting->calendar_event_id = $calendar_event->id;
			$meeting->save();



			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => '',
			);
		} else {
			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'No esta autorizado para realizar esta peticion',
			);
		}
		
		return response()->json($data);
	}

	public function checkSchedule($meet_id) {
		$meeting = Meeting::find($meet_id);
		$calendar_event = CalendarEvent::find($meeting->calendar_event_id);
		return response()->json($calendar_event);
	}

	public function confirmCalendarEvent(Request $request) {
		$calendar_event = CalendarEvent::find($request->calendar_event_id);

		if ($calendar_event) {
			$calendar_event->queue = 0;
			$calendar_event->save();
			
			$data = array(
				'code' => 200,
				'status' => 'success',
				'meesage' => 'Se confirmo la fecha y hora'
			);
		} else {
			$data = array(
				'code' => 403,
				'status' => 'error',
				'message' => 'No existe ese evento'
			);
		}
		return response()->json($data);
	}
}
