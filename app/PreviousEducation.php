<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousEducation extends Model
{
    protected $table = 'previous_education';
    public $timestamps = false;
    //protected $dateFormat = 'Y-m-d H:i:s+';

    protected $dates = [
        'BeginDate',
        'EndDate',
    ];

    protected $fillable = [
        'user_id',
        'education_level_id',
        'BeginDate',
        'EndDate',
        'university_id',
        'Speciality',
        'AdmissionScore',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function educationSection()
    {
        return $this->belongsTo(EducationSection::class);
    }

    public function educationForm()
    {
        return $this->belongsTo(EducationForm::class);
    }

    public function educationPaymentForm()
    {
        return $this->belongsTo(EducationPaymentForm::class);
    }
}
