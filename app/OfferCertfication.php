<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferCertfication extends Model
{
    public function offer()
    {
        $this->belongsTo(Offer::class);
    }
}
