<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table      = 'Admins';
    public $timestamps = false;
    protected $connection = 'sqlsrv2';

    //protected $dateFormat = 'Y-m-d H:i:s+';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'user_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//

//    public function getAuthIdentifier()
//    {
//        return $this->Email;
//    }
//
//    public function getAuthPassword()
//    {
//        return $this->Password;
//    }

/*    public function phones()
    {
        return $this->hasMany(MobilePhone::class);
    }

    public function finalEducation()
    {
        return $this->hasMany(FinalEducation::class);
    }

    public function previousEducations()
    {
        return $this->hasMany(PreviousEducation::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }*/
}
