<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class planesController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		/* $this->middleware('auth'); */
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$type_plans = Plan::all();
		
		if (!empty(Auth::user())) {
			$user = Auth::user();
			$plans = DB::table('plan_user')
						->where('user_id', $user->id)
						->orderBy('plan_id', 'DESC') ////////////////////////////
						->get();
			$data = [
				'user_plans' => $plans,
				'loged' => true,
				'type_plans' => $type_plans
			];

		} else {
			$data = [
				'loged' => false,
				'type_plans' => $type_plans
			];
		}
		
		return view('planes', compact('data'));
	}
	
	private function getCoinPacks(){
		$pack=DB::table('coin_packs')->all();
		$datos= [
			'pack'];
	return view('planes',compact('datos'));	
	}
}
