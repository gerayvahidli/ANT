<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermType extends Model
{
    protected $connection = 'sqlsrv2';
    protected $table      = 'term_types';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
    ];

    public function terms()
    {
        return $this->hasMany('App\Term');
    }
}
