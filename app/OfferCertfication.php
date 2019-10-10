<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferCertfication extends Model
{
	protected $fillable = [
		'title',
		'offer_id',
		'name_file',
		'url'
	];
	
	public function offer()
    {
        $this->belongsTo(Offer::class);
    }
}
