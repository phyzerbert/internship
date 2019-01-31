<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    protected $fillable = [
        'hobbies', 'description', 'pitch_text', 'experience'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Company')->using('App\CompanyPupil')->withPivot('id', 'state');
    }

    public function hours()
    {
        return $this->belongsToMany('App\Company')->using('App\Hour')->withPivot('id', 'state','description');
    }
}
