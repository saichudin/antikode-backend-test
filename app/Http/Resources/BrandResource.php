<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BrandResource extends JsonResource
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
            'logo' => Storage::disk('public')->url($this->logo),
            'banner' => Storage::disk('public')->url($this->banner),
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'outlets' => OutletResource::collection($this->whenLoaded('outlets')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
