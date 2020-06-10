<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalProgramApplication extends Model
{
    protected $table      = 'external_program_application';
    public    $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function placementStatus()
    {
        return $this->belongsTo(PlacementStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function first_stage_note()
    {
        return $this->belongsTo(ApplicationStageResultNote::class,'FirstSelStageResultNoteId','Id');
    }

    public function firstStageResult()
    {
        return $this->belongsTo(ApplicationStageResult::class,'FirstSelStageResultId','Id');
    }

    public function testStageResult()
    {
        return $this->belongsTo(ApplicationStageResult::class,'TestStageResultId','Id');
    }

    public function interviewStageResult()
    {
        return $this->belongsTo(ApplicationStageResult::class,'InterviewStageResultId','Id');
    }
}
