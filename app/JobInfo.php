<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobInfo extends Model
{
    protected $table = 'JobInfoes';

    public $timestamps = false;
    //protected $dateFormat = 'Y-m-d H:i:s+';

//    protected $dates = [
//        'StartDate',
//        'EndDate',
//    ];

    protected $fillable = [
        'UserId',
        'CompanyId',
        'Department',
        'Position',
        'Position',
        'StartDate',
        'TabelNo',
        'IsCurrent',
    ];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function company()
    {
        return $this -> belongsTo(Company::class,'CompanyId');
    }

}
