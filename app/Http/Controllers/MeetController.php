<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Message;
use App\Operation;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MeetController extends Controller
{
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

				$message = new Message();
				$message->title = 'Reunion agendada';
				$message->message = 'Se ha enviado la invitacion a '. $recevier->commercial_name .' con éxito. Se han consumido ' . $operation->coins_cost . ' de tus coins.';
				$message->date = Carbon::now();
				$message->user_id = $sender->id;
				$message->type_message_id = 3;
				$message->save();
	
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

	public function acceptMeet(Request $request)
	{
		return 'ok';
	}
}
