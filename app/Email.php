<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'Emails';
    public    $timestamps = false;
    protected $fillable   = [
        'userId',
        'email'
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
