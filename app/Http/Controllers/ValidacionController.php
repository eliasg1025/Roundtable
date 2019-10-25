<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ValidacionController extends Controller
{
    public function processRucFile(Request $request)
    {
    	return 'ok';
    }
}
