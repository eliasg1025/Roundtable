<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $dates = ['date'];
	
	protected $fillable = [
		'title',
		'message',
		'viewed',
		'date',
		'user_id',
		'type_message_id',
	];

    public function type_message() {
    	return $this->belongsTo(TypeMessage::class);
    }
}
