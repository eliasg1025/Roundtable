<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $fillable=[
       'ip',
       'port',
       'fecha',
       'user_id', 
    ];
    public function user(){
        return $this->belongsto(User::class);
    }

}
