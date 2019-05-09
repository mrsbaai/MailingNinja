<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['id', 'code', 'name'];


    public function offers()
    {
        return $this->belongsToMany('App\offer', 'publisher_offers', 'country_id', 'offer_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
