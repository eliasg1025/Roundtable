<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['value', 'user_id'];

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
