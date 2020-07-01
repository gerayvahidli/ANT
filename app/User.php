<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    //protected $dateFormat = 'Y-m-d H:i:s+';
    public $timestamps = false;

    protected $dates = [
        'Dob',
    ];

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

//    protected $casts = [
//        'IsCurrentlyWorking'      => 'boolean',
//        'IsCurrentlyWorkAtSocar'  => 'boolean',
//        'hasAppliedToScholarship' => 'boolean',
//    ];

//    public function getAuthIdentifier()
//    {
//        return $this->email;
//    }
//
//    public function getAuthPassword()
//    {
//        return $this->password;
//    }

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
        return $this->hasOne( FinalEducation::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function previousEducations()
    {
        return $this->hasMany( PreviousEducation::class );
    }

    public function previousInternships()
    {
        return $this->hasMany( PreviousInternship::class );
    }

    public function previousScholarships()
    {
        return $this->hasMany( PreviousScholarship::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function BirthCity()
    {
        return $this->belongsTo( City::class,'BirthCityId','Id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo( Country::class,'CitizenCountryId','Id'  );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function externalProgramApplications()
    {
        return $this->hasMany( ExternalProgramApplication::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function internalProgramApplications()
    {
        return $this->hasMany( InternalProgramApplication::class );
    }

    public function gender()
    {
        return $this->belongsTo( Gender::class );
    }




}
