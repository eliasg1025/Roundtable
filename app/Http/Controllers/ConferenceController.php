<?php

namespace App\Http\Controllers;

use App\CalendarEvent;
use App\Meeting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConferenceController extends Controller 
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware(['auth', 'verified']);
	}

	public function index(Request $request, Meeting $meeting) {

		if (! $request->hasValidSignature()) {
			abort(403);
		}

		$user_id = Auth::user()->id;

		if ($user_id == $meeting->sender_id || $user_id == $meeting->receiver_id) {
			return view('conference');
		} else {
			return view('ups', ['message' => 'No tienes acceso a esta página']);
		}

	}
}
