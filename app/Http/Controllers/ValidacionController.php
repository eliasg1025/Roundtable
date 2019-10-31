<?php

namespace App\Http\Controllers;

use App;
use App\Traits\UserData;
use App\Traits\NotificationMessage;
use App\Traits\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ValidacionController extends Controller
{
    use UserData;
    use NotificationMessage;
    use Verification;

    public function processRucFile(Request $request)
    {
		$user = Auth::user();
		$file = $request->file('file');

		if ($file) {
			switch ($this->userPlan($user)) {
				case 'premium':
	
					$file_name = time().'-'.$user->slug.'.'.$file->getClientOriginalExtension();
					$request->file->move(storage_path('app/user_verification/'), $file_name);
					
					$user->verified = 1;
					$user->save();
					
					$this->createMessage('envio_ruc', 0, 2, $user->id);
	
					// Enviar un correo a verificacion@roundtable.com
					$this->generateVerificationCode($user);
	
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
						
						$user->verified = 1;
						$user->coins -= $operation->coins_cost;
						$user->save();

						$this->createMessage('envio_ruc', $operation->coins_cost, 2, $user->id);

						$this->generateVerificationCode($user);

						$data = array(
							'code' => 200,
							'status' => 'success',
							'message' => 'La ficha RUC fue enviada exitosamente.',
							'text' => 'Verifique su correo electronico para mas información acerca de la validación',
						);
					}
					else 
					{
						$data = array(
							'code' => 401,
							'status' => 'error',
							'message' => 'Error',
							'text' => 'No cuenta con coins suficientes para realizar esta operación'
						);
					}
	
					break;
	
				case 'free':
					$data = array(
						'code' => 401,
						'status' => 'error',
						'message' => 'Con su plan actual no puede realizar esta operación',
						'text' => 'Es necesario el Plan Standard o Premium para poder verificar tu cuenta',
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

	public function validateAccount(Request $request)
	{
		$user = Auth::user();
		$recent_code = DB::table('verification_codes')
							->where('user_id', $user->id)
							->orderBy('created_at', 'DESC')
							->first();

		if ($recent_code->code === $request->code) {

			$this->createMessage('verificacion', 0, 4, $user->id);

			$user->verified = 2;
			$user->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message'  => '¡Cuenta verificada!',
				'text' => 'Felicidades ahora tienes una cuenta verificada',
			);
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message'  => 'Código de verificación incorrecto',
				'text' => 'Por favor ingrese el código nuevamente o contactése con nosotros',
			);
		}

		return response()->json($data, $data['code']);
	}
}
