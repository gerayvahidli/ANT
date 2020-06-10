<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table      = 'slides';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'show_in_home_page' => 'boolean',
    ];

    public function programType()
    {
        return $this->belongsTo('App\ProgramType');
    }

    public function imageSettings()
    {
        return [
            'height' => 350,
            'width' => 850,
            'directory' => 'uploads/images/slides/',
        ];
    }
}
