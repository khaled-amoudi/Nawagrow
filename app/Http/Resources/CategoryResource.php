<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use App\Http\Resources\PartResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            __('messages.name') => app()->getLocale() . '-' .$this->name,
            // parts in relation with category
            // 'parts' => $this->parts,
            'parts' => PartResource::collection($this->whenLoaded('parts')),
        ];
    }
}
