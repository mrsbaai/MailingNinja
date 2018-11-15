<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class offer extends Model
{

    protected $table = 'offers';
    protected $fillable = ['offer', 'thumbnail', 'promo', 'title', 'description', 'is_active', 'is_private', 'payout'];




    public function verticals()
    {
        return $this->belongsToMany('App\vertical', 'offer_vertical', 'offer_id', 'vertical_id');
    }


    public function users()
    {
        return $this->belongsToMany('App\user', 'publisher_offers', 'offer_id', 'user_id');
    }

    public function countries()
    {
        return $this->belongsToMany('App\country', 'offer_countries', 'offer_id', 'countries_id');
    }

    public function subscribes()
    {
        return $this->hasMany('App\subscribe_log','offer_id');
    }

    public function subscribers()
    {
        return $this->hasMany('App\subscriber','offer_id');
    }

    public function sells()
    {
        return $this->hasMany('App\sells','offer_id');
    }

    public function clicks()
    {
        return $this->hasMany('App\clicks','offer_id');
    }

}        