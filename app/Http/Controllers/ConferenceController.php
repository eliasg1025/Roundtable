<?php

namespace App\Http\Controllers;

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

	public function index() {
		return view('conference');
	}
}
