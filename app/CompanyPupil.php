<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyPupil extends Pivot
{
    protected $fillable = [
        'state'
    ];
}
