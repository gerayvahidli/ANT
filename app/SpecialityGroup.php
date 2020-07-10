<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialityGroup extends Model
{
    protected $table = 'SpecialityGroups';
    protected $primaryKey = 'Id';


    public function universities()
    {
        return $this->belongsToMany( University::class,'SpecialityGroupUniversity','SpecialityGroupRefId','UniversityRefId');
    }
}
