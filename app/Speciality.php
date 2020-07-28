<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Speciality extends Model
{
    use LogsActivity;
    protected $connection = 'sqlsrv2';
    protected $table      = 'specialities';
	public    $timestamps = true;
	//protected $dateFormat = 'Y-m-d H:i:s+';
	protected $dates      = [
		'updated_at',
		'published_at',
	];
    protected static  $logAttributes = ['title', 'slug', 'body', 'program_type_id'];


    public function programType()
	{
		return $this->belongsTo('App\ProgramType');
	}
}
