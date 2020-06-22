<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'Cities';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
