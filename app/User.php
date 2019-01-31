<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($role)
    {
        foreach ($this->roles as $roles) {
            return $roles->slug == $role;
        }
    }

    public function pupil()
    {
        return $this->hasOne('App\Pupil');
    }

    public function company()
    {
        return $this->hasOne('App\Company');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }
}
