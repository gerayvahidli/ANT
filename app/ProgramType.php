<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramType extends Model
{
    protected $table      = 'program_type';
    public    $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s+';
    protected $dates      = [
        'created_at',
        'updated_at',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function terms()
    {
        return $this->hasMany('App\Term');
    }

    public function faq()
    {
        return $this->hasMany(Faq::class);
    }

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }

	public function specialities()
	{
		return $this->hasMany(Speciality::class);
	}
}
