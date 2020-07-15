<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'Id';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
