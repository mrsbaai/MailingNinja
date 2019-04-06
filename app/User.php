<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_monetize','publisher_type', 'name', 'address', 'email', 'password','is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function offers()
    {
        return $this->belongsToMany('App\offer', 'publisher_offers', 'publisher_id', 'offer_id')->withTimestamps();;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function manager()
    {
        return $this->belongsTo('App\user', 'manager_id');
    }

    public function subscribes()
    {
        return $this->hasMany('App\subscribe_log','user_id');
    }

    public function subscribers()
    {
        return $this->hasMany('App\subscriber','user_id');
    }

    public function sells()
    {
        return $this->hasMany('App\sells','user_id');
    }

    public function clicks()
    {
        return $this->hasMany('App\clicks','user_id');
    }
    public function opens()
    {
        return $this->hasMany('App\opens','user_id');
    }

    public function authorizeRoles($roles)

    {

            if (is_array($roles)) {

            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');

        }

        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');

    }


    public function hasAnyRole($roles)

    {

        return null !== $this->roles()->whereIn('name', $roles)->first();

    }

    public function hasRole($role)

    {

        return null !== $this->roles()->where('name', $role)->first();

    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, $this->email));
    }



}
