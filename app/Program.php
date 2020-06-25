<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    //protected $dateFormat = 'Y-m-d H:i:s+';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programType()
    {
        return $this->belongsTo('App\ProgramType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function externalProgramApplications()
    {
        return $this->hasMany(ExternalProgramApplication::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function internalProgramApplications()
    {
        return $this->hasMany(InternalProgramApplication::class);
    }
}
