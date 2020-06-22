<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'Universities';

    public function finalEducation()
    {
        return $this->hasMany( FinalEducation::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
