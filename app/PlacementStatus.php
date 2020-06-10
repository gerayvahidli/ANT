<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlacementStatus extends Model
{
    protected $table = 'placement_status';

    public $timestamps = false;

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
