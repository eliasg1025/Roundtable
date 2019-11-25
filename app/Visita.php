<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $fillable=[
       'ip',
       'fecha',
       'contador',
       'user_id', 
    ];
    public function user(){
        return $this->belongsto(User::class);
    }

}
