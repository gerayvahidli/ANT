<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
	protected $table      = 'specialities';
	public    $timestamps = true;
	//protected $dateFormat = 'Y-m-d H:i:s+';
	protected $dates      = [
		'updated_at',
		'published_at',
	];

	public function programType()
	{
		return $this->belongsTo('App\ProgramType');
	}
}
