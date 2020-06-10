<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilePhone extends Model
{
    protected $table = 'mobile_phone';
    public    $timestamps = false;
    protected $fillable   = [
        'user_id',
        'mobile_operator_code_id',
        'PhoneNumber',
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
