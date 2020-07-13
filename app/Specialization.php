<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $primaryKey = 'Id';

    public function speciality()
    {
        return $this->belongsTo(SpecialityGroup::class, 'SpecialityGroupId');
    }

    public function universities()
    {
        return $this->belongsToMany(University::class, 'SpecializationUniversity', 'SpecializationRefId', 'UniversityRefId');
    }
}
