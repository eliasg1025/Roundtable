<?php

namespace App\Http\Controllers;

use App\Mail\MessageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactController extends Controller
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
    public function contacto(){
        return view('contact');
    }

    public function sendEmail(Request $request) {

    	$mail = [
    		'name' => $request->name,
    		'last_name' => $request->last_name,
    		'message' => $request->message,
    		'email' => $request->email,
    		'company_name' => $request->company_name,
    	];

    	Mail::to('contacto@roundtableperu.com')->send(new MessageContact($mail));
    
    	return 'Mensaje enviado';
    }
}
