<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialityGroup extends Model
{
    protected $table = 'SpecialityGroups';
    protected $primaryKey = 'Id';




    public function specializations()
    {
    	// added a filter to return only active ones
        return $this->hasMany(Specialization::class,'SpecialityGroupId','Id')->where('active', true);

    }

}
