<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscriber extends Model
{
    protected $table = 'subscribers';
    protected $fillable = [
        'offer_id', 'user_id', 'country', 'is_confirmed', 'email', 'created_at'
    ];
}
