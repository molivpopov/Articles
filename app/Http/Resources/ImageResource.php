<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $haveImage = (boolean)$this->name;

        return [
            'name' => $this->when($haveImage, $this->name),
            'link' => $this->when($haveImage, $this->link),
        ];
    }
}
