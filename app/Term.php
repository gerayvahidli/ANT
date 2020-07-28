<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Term extends Model
{
    use LogsActivity;
    protected $connection = 'sqlsrv2';
    protected $table      = 'terms';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
    ];
    protected static  $logAttributes = ['title', 'slug', 'body', 'program_type_id'];



    public function programType()
    {
        return $this->belongsTo('App\ProgramType');
    }

    public function termType()
    {
        return $this->belongsTo('App\TermType');
    }
}
