<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OutletResource extends JsonResource
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
            'name' => $this->name,
            'picture' => Storage::disk('public')->url($this->picture),
            'address' => $this->address,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'brand' => new BrandMinResource($this->whenLoaded('brand')),
        ];
    }
}
