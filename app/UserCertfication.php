<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCertfication extends Model
{
    protected $fillable = [
		'user_id',
		'title',
		'url',
		'name_file',
	];
}
