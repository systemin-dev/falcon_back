<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoatTranslationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'boat_id' => $this->boat_id,
            'locale' => $this->locale,
            'description' => $this->description,
            'base' => $this->base,
            'construction_type' => $this->construction_type,
            'flat_board' => $this->flat_board,
        ];
    }
}
