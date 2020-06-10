<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousInternship extends Model
{
    protected $table = 'previous_internships';

    protected $dates = ['internship_date'];


    public function user()
    {
        return $this->belongsTo( User::class );
    }
}
