<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'plan_user');
    }
}
