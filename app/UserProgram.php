<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProgram extends Model
{
    protected $table = 'UserPrograms';
    public    $timestamps = false;
    protected $fillable   = [
        'userId',
        'UserProgramStatusId'
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
