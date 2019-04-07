<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class link extends Model
{

    protected $table = 'links';
    protected $fillable = ['user_id', 'offer_id', 'price', 'cpa', 'cpc', 'income'];


}

