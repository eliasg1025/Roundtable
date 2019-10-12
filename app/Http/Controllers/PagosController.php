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
		$sample = DB::table($product)->where('slug', $slug);
		return view('pagos', compact('sample'));
	}
}
