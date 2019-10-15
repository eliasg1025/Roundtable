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
        $r = DB::table($product)->where('slug', $slug)->first();
        $data=[
            'product'=> $r,
            'type' => $product,
        ];
		return view('pagos', compact('data'));
	}
}
