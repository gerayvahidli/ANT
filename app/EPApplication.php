<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class EPApplication extends Model
{

    protected $table = 'EPApplications';
    //protected $dateFormat = 'Y-m-d H:i:s+';
    public $timestamps = false;
    protected $primaryKey = 'Id';

//    protected $dates = [
//        'Dob',
//    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ProgramId',
        'UserId',
        'SpecialityGroupId',
        'Speciality',
        'CountryId',
        'CityId',
        'CountryId',
        'CityId',
        'UniversityId',
        'MainModule',
        'AdditionalModule',
        'StartTime',
        'Amount',
        'CurrencyId',
        'EducationLang',
        'Achievments',
        'FamilyInfo',
        'PassportDocPath',
        'AboutCandidateDocPath',
        'AcceptDocPath',
        'CertificateDocPath',
        'MedicalDocPath',
        'depositDocPath',
        'ReferenceDocPath',
        'ApplyDate',
        'CurrentStageId',
        'SpecializationId',
        'EdEduLevelId',
        'EdInterval',
        'LastStageId'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public function applicationStage()
    {
        return $this -> belongsTo(ApplicationStage::class,'LastStageId','Id')->with('stage','stageResult');
    }

    public function applicationStageNotes()
    {
        return $this -> hasMany(AppStageNote::class,'ApplicationId');
    }


}
