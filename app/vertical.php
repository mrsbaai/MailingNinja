<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vertical extends Model
{

    protected $table = 'verticals';

    public function offers()
    {
        return $this->belongsToMany('app\offer', 'offer_vertical', 'vertical_id', 'offer_id');
    }

    public function subscribes()
    {
        return $this->hasMany('app\subscribe_log','vertical_id');
    }

    public function sells()
    {
        return $this->hasMany('app\sells','vertical_id');
    }
    public function clicks()
    {
        return $this->hasMany('app\clicks','vertical_id');
    }
}

