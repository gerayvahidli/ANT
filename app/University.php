<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'Universities';
    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function finalEducation()
    {
        return $this->hasMany( FinalEducation::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'CountryId');
    }

//    public function specialities()
//    {
//        return $this->belongsToMany( SpecialityGroup::class,'SpecialityGroupUniversity','UniversityRefId','SpecialityGroupRefId');
//    }

}
