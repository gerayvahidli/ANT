<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class LangLevel extends Model
{

    protected $table = 'LangLevels';
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
        'CertificateId',
        'ApplicationId',
        'Writting',
        'Listening',
        'Reading',
        'Speaking'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */




}
