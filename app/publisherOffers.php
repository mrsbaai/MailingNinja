<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class publisherOffers extends Model
{

    protected $table = 'publisher_offers';
    protected $fillable = ['id', 'publisher_id', 'offer_id', 'created_at'];



}        