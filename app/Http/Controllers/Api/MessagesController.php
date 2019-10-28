<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(Request $request)
    {
    	$user = Auth::user();
    	$messages = App\Message::where('user_id', $user->id)
    							->orderBy('created_at', 'DESC')
    							->get();

		$data = array();

		foreach ($messages as $message) {
			$type_message = App\TypeMessage::find($message->type_message_id);

			array_push($data, array(
				'message' => $message,
				'type_message' => $type_message
			));

			unset($type_message);
		}

		$data = array(
			'data' => $data,
			'code' => 200,
			'status' => 'success',
		);

		return response()->json($data, $data['code']);
    }
}
