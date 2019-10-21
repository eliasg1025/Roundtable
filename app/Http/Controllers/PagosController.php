<?php

namespace App\Http\Controllers;

use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Culqi\Culqi;
use Culqi\CulqiException;

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
			
			$SECRET_API_KEY = 'sk_test_TmUKwOHr7nj9gLv1';
			$culqi = new Culqi(array('api_key' => $SECRET_API_KEY));
			
			$product = DB::table($request->type)->where('slug', $request->product)->first();
			
			$data = array(
				'amount' => round($product->cost * 100),
				"capture" => true,
				"currency_code" => "USD",
				"description" => $product->name,
				"email" => $request->email,
				"installments" => 0,
				"source_id" => $request->token,
				'metadata' => array(
					'Razon Social' => $user->name,
					'RUC' => $request->ruc
				),
				'antifraud_details' => array(
					'first_name' => $request->cardholder,
				),
			);
			
			// Crear cargo de culqi
			$culqi->Charges->create($data);

			if ($request->type == 'plans')
			{
				$user->coins += $product->initial_coins;
				$user->save();
				$user->plans()->attach([$product->id]);

				$message = new Message();
				$message->title = 'Transacción exitosa';
				$message->message = '¡Ha adquirido el Plan ' . $product->name . '!';
				$message->date = Carbon::now();
				$message->type = 'transaction';
				$message->user_id = $user->id;
				$message->save();
				
				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'La transacción se ha completado exitosamente',
					'text' => '¡Ha adquirido el Plan ' . $product->name . '!',
				);
			}
			elseif ($request->type == 'coin_packs')
			{
				$user->coins += $product->amount_coins;
				$user->save();

				$message = new Message();
				$message->title = 'Transacción exitosa';
				$message->message = '¡Ha adquirido el Paquete ' . $product->amount_coins . ' coins!';
				$message->date = Carbon::now();
				$message->type = 'transaction';
				$message->user_id = $user->id;
				$message->save();

				
				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'La transacción se ha completado exitosamente',
					'text' => '¡Ha adquirido el Paquete ' . $product->amount_coins . ' coins!',
				);
			}
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Hubo un error al momento de realizar la transacción'
			);
		}

		return response()->json($data, $data['code']);
	}
}
