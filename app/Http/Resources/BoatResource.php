<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'image' => asset("storage/" . $this->image),
            'condition' => $this->condition,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'dimensions' => DimensionResource::collection($this->whenLoaded('dimensions')),
            'ranges' => BoatRangeResource::collection($this->whenLoaded('boatRanges')),
            'translations' => BoatTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
