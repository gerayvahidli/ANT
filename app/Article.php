<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table      = 'articles';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    public function programType()
    {
        return $this->belongsTo('App\ProgramType');
    }
}
