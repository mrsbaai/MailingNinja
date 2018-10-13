<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vertical extends Model
{

    protected $table = 'verticals';
    protected $fillable = ['vertical', 'descrption'];



    public function offers()
    {
        return $this->belongsToMany('App\offer', 'offer_vertical', 'vertical_id', 'offer_id');
    }

    public function subscribes()
    {
        return $this->hasMany('App\subscribe_log','vertical_id');
    }

    public function clicks()
    {
        return $this->hasMany('App\clicks','vertical_id');
    }
}

