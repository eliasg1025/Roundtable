<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ruc',
        'legal_registration',
        'phone',
        'address',
        'type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function type() // $user->type->name
    {
        return $this->belongsTo(Type::class); // Pertenece a un type
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_user');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function offers() // $user->offers
    {
        return $this->hasMany(Offer::class);
    }


}
