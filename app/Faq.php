<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
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

    public function programType()
    {
        return $this->belongsTo('App\ProgramType');
    }
}
