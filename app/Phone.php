<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Phone extends Model
{
    use LogsActivity;

    protected $table = 'Phones';
    public    $timestamps = false;
    protected $primaryKey = 'Id';
    protected $fillable   = [
        'userId',
        'OperatorCodeId',
        'PhoneNumber',
        'PhoneTypeId',
        'AuditInsertedUserId',
        'AuditInsertedDateTime'
    ];

    protected static  $logAttributes = ['title', 'OperatorCodeId', 'PhoneNumber', 'PhoneTypeId'];

    public function user()
    {
        return $this->belongsTo(User::class,'UserId','Id');
    }

    public function operatorCode()
    {
        return $this->belongsTo( MobileOperatorCode::class, 'OperatorCodeId', 'Id');
    }
}
