<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table      = 'terms';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
    ];

    public function programType()
    {
        return $this->belongsTo('App\ProgramType');
    }

    public function termType()
    {
        return $this->belongsTo('App\TermType');
    }
}
