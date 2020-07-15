<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class BankGuarantee extends Model
{

    protected $table = 'BankGuarantees';
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
        'BankId',
        'Amount',
        'CurrencyId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */




}
