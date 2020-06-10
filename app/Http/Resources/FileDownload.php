<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\ExternalProgramApplication;
use Storage;



class FileDownload extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'filename' => $this->filename,
            'path'=>Storage::disk('public')->path($this->user_id.'/'.$this->id.'/'.$this->filename)
            
        ];
    }
}
