<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function offer_certifications()
    {
        return $this->hasMany(OfferCertfication::class);
    }
}
