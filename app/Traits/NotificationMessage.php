<?php

namespace App\Traits;

use App\User;
use App\Message;
use App\TypeMessage;
use App\Events\NotificationEvent;
use Carbon\Carbon;

/**
 * Crear notificacion en la DB y el activar evento de notificacion
 */

trait NotificationMessage
{
	private function activeEvent($message, $date, $type_message_id)
	{
		$data_notification = array(
			'message' => $message,
			'date' => $date,
			'picture' => TypeMessage::find($type_message_id)->picture,
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
}
