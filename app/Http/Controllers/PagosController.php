<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index($product, $slug){
		$r = DB::table($product)->where('slug', $slug)->first();
		$user = Auth::user();
        $data=[
            'product'=> $r,
			'type' => $product,
			'user' => $user,
        ];
		return view('pagos', compact('data'));
	}

	public function processPayment(Request $request)
	{
		$user = Auth::user();

		$given_user = DB::table('users')->where('ruc', $request->ruc)->first();

		if ($user->id == $given_user->id) {
			
			return $request;

		}
	}
}
