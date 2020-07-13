<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialityGroup extends Model
{
    protected $table = 'SpecialityGroups';
    protected $primaryKey = 'Id';




    public function specializations()
    {
        return $this->hasMany(Specialization::class,'SpecialityGroupId','Id');

    }

}
