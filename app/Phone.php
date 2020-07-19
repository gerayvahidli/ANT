<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'Phones';
    public    $timestamps = false;
    protected $primaryKey = 'Id';
    protected $fillable   = [
        'userId',
        'OperatorCodeId',
        'PhoneNumber',
        'PhoneTypeId'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'UserId','Id');
    }

    public function operatorCode()
    {
        return $this->belongsTo( MobileOperatorCode::class, 'OperatorCodeId', 'Id');
    }
}
