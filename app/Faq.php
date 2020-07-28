<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Faq extends Model
{
    use LogsActivity;
    protected $connection = 'sqlsrv2';
    protected $table      = 'faqs';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
    	'title', 'slug', 'answer', 'program_type_id'
    ];

    protected static  $logAttributes = ['title', 'slug', 'answer', 'program_type_id'];


    public function programType()
    {
        return $this->belongsTo('App\ProgramType');
    }
}
