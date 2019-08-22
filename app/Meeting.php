<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public function sender()
    {
        $this->belongsTo(User::class);
    }

    public function receiver()
    {
        $this->belongsTo(User::class);
    }

    public function state()
    {
        $this->belongsTo(State::class);
    }

    public function operation()
    {
        $this->belongsTo(Operation::class);
    }
}
