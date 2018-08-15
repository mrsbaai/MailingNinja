<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vertical extends Model
{

    protected $table = 'verticals';

    public function offers()
    {
        return $this->belongsToMany('App\offer', 'offer_vertical', 'vertical_id', 'offer_id');
    }

    public function subscribes()
    {
        return $this->hasMany('App\subscribe_log','vertical_id');
    }

    public function sells()
    {
        return $this->hasMany('App\sells','vertical_id');
    }
    public function clicks()
    {
        return $this->hasMany('App\clicks','vertical_id');
    }
}

