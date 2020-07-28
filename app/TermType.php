<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TermType extends Model
{
    use LogsActivity;
    protected $connection = 'sqlsrv2';
    protected $table      = 'term_types';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
    ];
    protected static  $logAttributes = ['title', 'slug'];


    public function terms()
    {
        return $this->hasMany('App\Term');
    }
}
