<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Internal extends JsonResource
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
            'path'=> asset('storage/application/internal/'.$this->user_id.'/'.$this->id.'/'.$this->filename)  
            
        ];
    }
}
