<?php

namespace App\Http\Controllers;

use App;
use App\Traits\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ValidacionController extends Controller
{
    use UserData;

    public function processRucFile(Request $request)
    {
		$user = Auth::user();
		$file = $request->file('file');

		if ($file) {
			switch ($this->userPlan($user)) {
				case 'premium':
	
					$file_name = time().'-'.$user->slug.'.'.$file->getClientOriginalExtension();
					$request->file->move(storage_path('app/user_verification/'), $file_name);
	
					// Enviar un correo a verificacion@roundtable.com
	
					$data = array(
						'code' => 200,
						'status' => 'success',
						'message' => 'La ficha RUC fue enviada exitosamente.'
					);
					break;
				
				case 'standard':
	
					$operation = App\Operation::where('name', 'Solicitar verificación')->first();


					if ($operation->coins_cost <= $user->coins)
					{
						$file_name = time().'-'.$user->slug.'.'.$file->getClientOriginalExtension();
						$request->file->move(storage_path('app/user_verification/'), $file_name);

						$user->coins -= $operation->coins_cost;
						$user->save();

						$data = array(
							'code' => 200,
							'status' => 'success',
							'message' => 'La ficha RUC fue enviada exitosamente.'
						);
					}
					else 
					{
						$data = array(
							'code' => 401,
							'status' => 'error',
							'message' => 'No cuenta con coins suficientes para realizar esta operación',
						);
					}
	
					break;
	
				case 'free':
					$data = array(
						'code' => 401,
						'status' => 'error',
						'message' => 'Con su plan actual no puede realizar esta operación'
					);
					break;
			}
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'No ha enviado ningun documento'
			);
		}

		return response()->json($data, $data['code']);
	}
}
