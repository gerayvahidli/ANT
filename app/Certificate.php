<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'Certificates';
    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = [
        'Name',
        'IsShow'
    ];
}
