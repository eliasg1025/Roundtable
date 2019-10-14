<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index($product, $slug){
		$data = DB::table($product)->where('slug', $slug)->first();
		return view('pagos', compact('data'));
	}
}
