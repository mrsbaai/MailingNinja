<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class offer extends Model
{

    protected $table = 'offers';

    public function verticals()
    {
        return $this->belongsToMany('app\vertical', 'offer_vertical', 'offer_id', 'vertical_id');
    }


    public function users()
    {
        return $this->belongsToMany('app\user', 'publisher_offers', 'offer_id', 'user_id');
    }

    public function countries()
    {
        return $this->belongsToMany('app\country', 'offer_countries', 'offer_id', 'countries_id');
    }

    public function subscribes()
    {
        return $this->hasMany('app\subscribe_log','offer_id');
    }

    public function subscribers()
    {
        return $this->hasMany('app\subscriber','offer_id');
    }

    public function sells()
    {
        return $this->hasMany('app\sells','offer_id');
    }

    public function clicks()
    {
        return $this->hasMany('app\clicks','offer_id');
    }

}        