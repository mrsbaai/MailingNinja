<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class offer extends Model
{

    protected $table = 'offers';
    protected $fillable = ['color', 'cpc', 'offer', 'thumbnail', 'promo', 'title', 'description', 'is_active', 'is_private', 'payout', 'subtitle', 'book_about_1', 'book_about_2', 'book_about_3', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'image_6',  'image_7',  'image_8',  'image_9',  'author_image', 'author_name', 'author_about', 'review_name_1', 'review_content_1', 'review_name_2', 'review_content_2', 'review_name_3', 'review_content_3', 'review_name_4', 'review_content_4', 'review_name_5', 'review_content_5', 'review_name_6', 'review_content_6'];




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