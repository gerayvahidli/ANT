<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'Countries';

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function universities()
    {
        return $this->hasMany(University::class);
    }

}
