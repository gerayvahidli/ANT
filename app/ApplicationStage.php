<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStage extends Model
{
    protected $table = 'ApplicationStages';
    protected $primaryKey = 'Id';


    public function stage()
    {
        return $this -> belongsTo(Stage::class,'StageId','Id');
    }

    public function stageResult()
    {
        return $this -> belongsTo(StageResult::class,'StageResultId','Id');
    }
}