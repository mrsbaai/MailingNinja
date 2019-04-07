<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cpa extends Model
{
    protected $table = 'cpa_log';
    protected $fillable = ['count', 'value'];
}
