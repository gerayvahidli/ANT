<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'Phones';
    public    $timestamps = false;
    protected $fillable   = [
        'userId',
        'OperatorCodeId',
        'PhoneNumber',
        'PhoneTypeId'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operatorCode()
    {
        return $this->belongsTo( MobileOperatorCode::class, 'mobile_operator_code_id', 'id');
    }
}
