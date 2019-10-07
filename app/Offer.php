<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
    	'title',
    	'user_id',
    	'image_url',
    	'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function offer_certifications()
    {
        return $this->hasMany(OfferCertfication::class);
    }
}
