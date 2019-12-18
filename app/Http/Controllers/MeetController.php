<?php

namespace App\Http\Controllers;

use App\{AvalibleTime, Meeting, Message, Operation, User};
use App\Traits\NotificationMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB, URL};
use Illuminate\Http\Request;

class MeetController extends Controller
{
    use NotificationMessage;

    public function __construct()
    {
        $this->middleware(['auth','verified']);
	}
	
	/*
	 * @return json
	 * 
	 * $request = [
	 * 		sender_id,
	 * 		receiver_id,
 * 			day,
	 * 		hour,
	 * ]
	 */
	public function createMeet(Request $request)
	{
		$sender = User::find(Auth::user()->id);
		$operation = Operation::find(4);
		
		if ($sender->id == $request->sender_id) {
			
			if ($sender->coins >= $operation->coins_cost) {
				$receiver = User::find($request->receiver_id);

				$sender_avalible_time = AvalibleTime::where('user_id', $sender->id)->get();
				$receiver_avalible_time = AvalibleTime::where('user_id', $receiver->id)->get();

				if (count($sender_avalible_time) > 0 && count($receiver_avalible_time) > 0) {

					$date = $request->day['year'] . "-" . ($request->day['month'] + 1) . "-" . $request->day['date'];
					$time = $request->hour['hour'];

					$datetime = $date . " " . $time;
					
					// Verificar si hay algun cruce de horarios de estos usuarios con la reunion
					$overbooking = $this->meetingOverbooking($sender->id, $datetime) || $this->meetingOverbooking($receiver->id, $datetime);
					
					if (!$overbooking) {
						$meet = new Meeting();
						$meet->title = "Reunion: " . $sender->commercial_name . " - " . $receiver->commercial_name;
						$meet->date = $datetime;
						$meet->sender_id = $request->sender_id;
						$meet->receiver_id = $request->receiver_id;
						$meet->message = $request->message;
						$meet->state_id = 1;
						$meet->save();
						
						// Consumir coins del usuario que envia
						$sender->coins = $sender->coins - $operation->coins_cost;
						$sender->save();

						// To user
						$this->createMessage('reunion', $operation->coins_cost, 3, $sender->id, $receiver->commercial_name);
						// To reciever
						$this->requestMeet($sender, $receiver->id);

						$data = [
							'code' => 200,
							'status' => 'success',
							'message' => 'Reunión agendada con éxito',
						];
					} else {
						$data = [
							'code' => 403,
							'status' => 'error',
							'message' => 'Ya hay un evento programado a esta hora. Selecciona otra fecha u hora'
						];	
					}
				} else {
					$data = array(
						'code' => 403,
						'status' => 'error',
						'message' => 'El remitente o usted no tienen horarios disponibles asignados'
					);
				}
				
			} else {
				$data = [
					'code' => 403,
					'status' => 'error',
					'message' => 'No cuentas con coins suficientes'
				];
			}

		} else {
			$data = [
				'code' => 401,
				'status' => 'error',
				'message' => 'Error de autenticación'
			];
		}

		return response()->json($data, $data['code']);
	}

	private function meetingOverbooking($user_id, $datetime) {
		$meetings = Meeting::where('sender_id', $user_id)->orWhere('receiver_id', $user_id)->get();

		foreach ($meetings as $meeting) {
			if ($meeting->date === $datetime && $meeting->state_id === 1) {
				return true;
			}
		}
		return false;
	}

	public function checkMeet($receiver_id)
	{
		$sender = Auth::user();
		$receiver = User::find($receiver_id);
		
		$last_meet = DB::table('meetings')
						->where('sender_id', $sender->id)
						->where('receiver_id', $receiver->id)
						->orderBy('created_at', 'DESC')
						->first();
		
		if ($last_meet) {
			$data = array(
				'code' => 200,
				'status' => 'success',
				'data' => $last_meet,
			);
		} else {
			$data = array(
				'code' => 404,
				'status' => 'error',
				'message' => 'No hay agendamientos previos con esta empresa'
			);
		}
		
		return response()->json($data, $data['code']);
	}

	public function responseRequestMeet(Request $request)
	{
		$user = Auth::user();
		$meet = Meeting::find($request->meeting_id);

		if ($user->id == $meet->receiver_id) {
			if ($request->operation) {
				$meet->state_id = 3;
				$meet->link = $this->getLinkConference($meet);
				$respuesta = 'aceptada';
			} else {
				$meet->state_id = 2;
				$respuesta = 'rechazada';
			}
			
			$meet->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'La solicitud fue '.$respuesta.' exitosamente',
			);
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'No esta autorizado para realizar esta operación'
			);
		}

		return response()->json($data, $data['code']);
	}
	
	public function cancelMeet(Request $request)
	{
		$user = Auth::user();
		$meet = Meeting::find($request->meet_id);

		if ($user->id == $meet->receiver_id || $user->id == $meet->sender_id) {
			$meet->state_id = 2;
			$meet->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'El agendamiento fue cancelado',
			);
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'No esta autorizado para realizar esta operación'
			);
		}

		return response()->json($data, $data['code']);
	}
	
	public function endMeet(Request $request)
	{
		$meeting = Meeting::find($request->meeting_id);
		$meeting->state_id = 4;
		
		if ($meeting->save()) {
			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Reunión concluida',
			);
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Ha ocurrido un error',
			);
		}

		return response()->json($data);
	}

	public function getLinkConference(Meeting $meeting)
	{
		$date = Carbon::createFromDate($meeting->date);
		return URL::temporarySignedRoute(
			'conference',
			$date->addMinutes($meeting->max_duration),
			['meeting' => $meeting]
		);
	}	
}
