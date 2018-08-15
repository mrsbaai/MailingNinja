<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table = 'contacts';
    public function role()
    {
        return $this->belongsto('App\role', 'role_id');
    }

}
