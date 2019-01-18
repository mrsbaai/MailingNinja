<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPal extends Model
{
    protected $table = 'paypal_accounts';
    protected $fillable = ['id', 'paypal_id', 'email','balance','notes','is_active', 'created_at'];

}
