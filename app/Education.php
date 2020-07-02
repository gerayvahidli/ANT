<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'Educations';

    public $timestamps = false;
    //protected $dateFormat = 'Y-m-d H:i:s+';

//    protected $dates = [
//        'StartDate',
//        'EndDate',
//    ];

    protected $fillable = [
        'UserId',
        'EducationLevelId',
        'UniversityId',
        'StartDate',
        'EndDate',
        'IsCurrent',
        'Faculty',
        'Speciality',
        'AdmissionScore',
        'EducationSectionId',
        'EducationFormId',
        'EducationPaymentFormId',
        'GPA',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class,'EducationLevelId','Id');
    }

    public function university()
    {
        return $this->belongsTo(University::class,'UniversityId');
    }

    public function educationSection()
    {
        return $this->belongsTo(EducationSection::class,'EducationSectionId');
    }

    public function educationForm()
    {
        return $this->belongsTo(EducationForm::class,'EducationFormId');
    }

    public function educationPaymentForm()
    {
        return $this->belongsTo(EducationPaymentForm::class,'EducationPaymentFormId');
    }
}
