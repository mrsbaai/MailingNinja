<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class costumerOffers extends Model
{

    protected $table = 'costumer_offers';
    protected $fillable = ['id', 'publisher_id', 'costumer_id', 'offer_id', 'price', 'paid', 'created_at'];



}
