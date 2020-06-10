<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousScholarship extends Model
{
    protected $table = 'previous_scholarships';
    // protected $dateFormat = 'Y-m-d H:i:s';
    protected $dates = ['scholarship_date'];

    public function programType()
    {
        return $this->belongsTo( ProgramType::class );
    }

    public function user()
    {
        return $this->belongsTo( User::class );
    }
}
