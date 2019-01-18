<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unsubscribes extends Model
{
    protected $table = 'unsubscribes';

    protected $fillable = [
        'offer_id', 'user_id', 'email', 'created_at'
    ];
}
