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
	public function createMessage($elemento, $cost, $type_message, $user_id)
	{
		$message = new Message();
		$message->title = ucfirst($elemento) . ' agregado';
		$message->message = 'El '. $elemento . ' fue agregado satisfactoriamente. Se han consumido ' . $cost . ' de tus coins.';
		$message->date = Carbon::now();
		$message->type_message_id = $type_message;
		$message->user_id = $user_id;
		$message->save();

		$data_notification = array(
			'message' => $message->message,
			'date' => $message->date,
			'picture' => TypeMessage::find($message->type_message_id)->picture,
		);
		event(new NotificationEvent($data_notification));
	}
}