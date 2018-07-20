<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table = 'countries';


    public function offers()
    {
        return $this->belongsToMany('app\offer', 'publisher_offers', 'country_id', 'offer_id');
    }
}
