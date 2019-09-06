<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
	public function index()
	{
		$users = User::paginate(10);
		return response()->json($users);
	}
	
	public function show($slug)
	{
		$uuid = substr($slug, -5);
		$user = User::whereUuid($uuid)->firstOrFail();

		if ($slug !== $user->slug) {
			return redirect()->to($user->url);
		}

		return view('business', compact('user'));
	}

	public function category($slug)
	{
		$user = User::where('slug', $slug)->paginate(10);
	}
}
