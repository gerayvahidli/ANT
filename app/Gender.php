<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{

    protected $table = 'Genders';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
