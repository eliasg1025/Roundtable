<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $fillable = [
    	'code',
    	'user_id'
    ];

    public function user()
    {
    	$this->belongsTo(User::class);
    }
}
