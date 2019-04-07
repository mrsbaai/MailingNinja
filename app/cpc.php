<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cpc extends Model
{
    protected $table = 'cpc_log';
    protected $fillable = ['count', 'value'];
}
