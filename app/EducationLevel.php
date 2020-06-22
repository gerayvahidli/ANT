<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    protected $table = 'EducationLevels';
    protected $guarded = ['id'];

    public function previous_educations()
    {
        return $this->hasMany(PreviousEducation::class);
    }
}
