<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Paid extends JsonResource
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
            'path'=> asset('storage/application/paid/'.$this->user_id.'/'.$this->id.'/'.$this->filename)  
            
        ];
    }
}
