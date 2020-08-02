<?php

namespace App\Traits;

use App\User;
use App\Message;
use App\TypeMessage;
use App\Events\NotificationEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Crear notificacion en la DB y el activar evento de notificacion
 */

trait NotificationMessage
{
	private function activeEvent($message, $date, $type_message_id, $custom_image=false)
	{
		$picture = $custom_image ? $custom_image : TypeMessage::find($type_message_id)->picture;

		$data_notification = array(
			'message' => $message,
			'date' => $date,
			'picture' => $picture,
			'user_id' => Auth::user()->id,
		);
		event(new NotificationEvent($data_notification));
	}

	public function createMessage($elemento, $cost=false, $type_message, $user_id, $recevier_name=false)
	{
		$message = new Message();

		switch ($elemento) {
			case 'bienvenida':
				
				$username = User::find($user_id)->commercial_name;

				$message->title = 'Bienvenido ' . $username;
				$message->message = 'Bienvenido ' . $username . ', se te asigno el Plan Free';
				break;

			case 'reunion':
				$message->title = ucfirst($elemento). ' agendada';
				$message->message = 'Se ha enviado la invitacion a '. $recevier_name .' con éxito. Se han consumido ' . $cost . ' de tus coins.';
				break;
				
			case 'envio_ruc':
				$message->title = 'Ficha RUC enviada';
				$message->message = 'Se ha enviado la Ficha RUC. Se ha consumido '.$cost.' coins de tu cuenta.';
				break;

			case 'verificacion':
				$username = User::find($user_id)->commercial_name;

				$message->title = 'Cuenta verificada';
				$message->message = '¡Felicidades!, ahora '. $username . ' es una empresa verificada.';
				break;
				
			default:
				$message->title = ucfirst($elemento) . ' agregado';
				$message->message = 'El '. $elemento . ' fue agregado satisfactoriamente. Se han consumido ' . $cost . ' de tus coins.';
				break;
		}

		$message->date = Carbon::now();
		$message->user_id = $user_id;
		$message->type_message_id = $type_message;
		$message->save();

		$this->activeEvent($message->message, $message->date, $message->type_message_id);
	}
	
	public function requestMeet(User $user, $receiver_id)
	{
		$message = new Message();
		$message->title = 'Solicitud de reunión';
		$message->message = $user->commercial_name . ' desea agendar una reunión virtual con su empresa.';
		$message->date = Carbon::now();
		$message->user_id = $receiver_id;
		$message->type_message_id = 3;
		$message->customImage = $user->profile_img;
		$message->save();
		
		$this->activeEvent($message->message, $message->date, $message->type_message_id, $user->profile_img); //
	}
}
