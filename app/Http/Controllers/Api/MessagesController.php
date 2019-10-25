<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
    	$messages = DB::table('messages')->where('uuid', $request->uuid)->get();
    	return response()->json($messages);
    }
}
