<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeMessage extends Model
{
    public function type_message()
	{
		return $this->hasMany(Message::class);
	}
}
