<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Message;
use App\Operation;
use App\User;
use App\Traits\NotificationMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MeetController extends Controller
{
    use NotificationMessage;

    public function __construct()
    {
        $this->middleware(['auth','verified']);
	}
	
	public function createMeet(Request $request)
	{
		$sender = Auth::user();
		$operation = Operation::find(4);
		
		if ($sender->id == $request->sender_id) {
			
			if ($sender->coins >= $operation->coins_cost) {
				$recevier = User::find($request->receiver_id);
				
				$meet = new Meeting();
				$meet->sender_id = $request->sender_id;
				$meet->receiver_id = $request->receiver_id;
				$meet->message = $request->message;
				$meet->state_id = 1;
				$meet->save();

				$sender->coins = $sender->coins - $operation->coins_cost;
				$sender->save();
				
				// To user
				$this->createMessage('reunion', $operation->coins_cost, 3, $sender->id, $recevier->commercial_name);
				// To reciever
				$this->requestMeet($sender);
	
				$data = [
					'code' => 200,
					'status' => 'success',
					'message' => 'Reunión agendada con éxito',
				];	
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

	public function checkMeet(Request $request)
	{
		$sender = Auth::user();
		$receiver = User::find($request->receiver_id);
		
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
		$meet = Meeting::find($request->meet_id);

		if ($user->id == $meet->receiver_id) {
			if ($request->operation) {
				$meet->state_id = 3;
				$respuesta = 'aceptada';
			} else {
				$meet->state_id = 2;
				$respuesta = 'rechaza';
			}
			
			$meet->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'La solicitud fue '.$respuesta,
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
}
