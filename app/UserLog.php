<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Queue\Jobs\Job;

class UserLog extends Authenticatable
{
    use Notifiable;

    protected $table = 'UserLogs';
    //protected $dateFormat = 'Y-m-d H:i:s+';
    public $timestamps = false;

    protected $dates = [
        'Dob',
    ];

    protected $primaryKey = 'LogId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirstName',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phones()
    {
        return $this->hasMany( Phone::class,'UserId' );
    }

    public function emails()
    {
        return $this->hasMany( Email::class,'UserId' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function finalEducation()
    {
        return $this->hasMany( Education::class,'UserId' ) -> where('IsCurrent',1);
    }
    public function previousEducations()
    {
        return $this->hasMany( Education::class,'UserId' ) -> where('IsCurrent',0);
    }

    public function currentJob()
    {
        return $this->hasMany( JobInfo::class,'UserId' ) -> where('IsCurrent',1);
    }
    public function previousJobs()
    {
        return $this->hasMany( JobInfo::class,'UserId' ) -> where('IsCurrent',0);
    }




    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function BirthCity()
    {
        return $this->belongsTo( City::class,'BirthCityId','Id' );
    }

    public function region()
    {
        return $this->belongsTo( Region::class,'RegionId','Id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo( Country::class,'CitizenCountryId','Id'  );
    }


    public function gender()
    {
        return $this->belongsTo( Gender::class );
    }


    public function userPrograms()
    {
        return $this->hasMany( UserProgram::class,'UserId','id' );
    }

    public function applications()
    {
        return $this -> hasMany(EPApplication::class,'UserId','id')->with('applicationStageNotes','applicationStage');
    }





}
