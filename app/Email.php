<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Email extends Model
{
    use LogsActivity;

    protected $table = 'Emails';
    public    $timestamps = false;
    protected $fillable   = [
        'userId',
        'email',
        'AuditInsertedUserId',
        'AuditInsertedDateTime'
    ];

    protected static  $logAttributes = ['userId', 'email'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operatorCode()
    {
        return $this->belongsTo( MobileOperatorCode::class, 'mobile_operator_code_id', 'id');
    }
}
