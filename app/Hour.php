<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = [
        'pupil_id', 'company_id', 'hour', 'week', 'description', 'state'
    ];
}
