<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileOperatorCode extends Model
{
    protected $table = 'mobile_operator_code';

    public function mobilePhone()
    {
        return $this->hasMany(MobilePhone::class , 'mobile_operator_code_id', 'id');
    }
}
