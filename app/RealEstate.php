<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class RealEstate extends Model
{

    protected $table = 'RealEstates';
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
        'ApplicationId',
        'DepositId',
        'Address',
        'Owner',
        'Phone',
        'Email',
        'SerialNo',
        'ReyestrNo',
        'RegistrNo',
        'RegistrDate',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */




}
