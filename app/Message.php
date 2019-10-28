<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $dates = ['date'];

    public function type_message() {
    	return $this->belongsTo(TypeMessage::class);
    }
}
