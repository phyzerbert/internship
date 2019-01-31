<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'school_name'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
