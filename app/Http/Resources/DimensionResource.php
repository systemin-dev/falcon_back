<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DimensionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'boat_id' => $this->boat_id,
            'boat_type' => $this->boat_type,
            'weight_range' => $this->weight_range,
            'mold_number' => $this->mold_number,
            'length_cm' => $this->length_cm,
            'shape' => $this->shape,
        ];
    }
}
