<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'phone_number', 'branch', 'description', 'employs_number'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function Pupils()
    {
        return $this->belongsToMany('App\Pupil')->using('App\CompanyPupil')->withPivot('id', 'state');
    }

}
