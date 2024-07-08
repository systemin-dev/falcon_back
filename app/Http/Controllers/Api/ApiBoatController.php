<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoatResource;
use App\Models\Boat;
use App\Traits\ApiResponse;

class ApiBoatController extends Controller
{
    use ApiResponse;

    public function index($locale)
    {
        $boats = Boat::with(['dimensions', 'boatRanges', 'translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->paginate(12);
        return $this->retrieveResponse(data: BoatResource::collection($boats));
    }

    public function getRangeBoats($locale, $range)
    {
        $boats = Boat::whereHas('boatRanges', function ($query) use ($range) {
            $query->where('name', $range);
        })->with(['dimensions', 'boatRanges', 'translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->paginate(12);
        return $this->retrieveResponse(data: BoatResource::collection($boats));
    }

    public function getTypeBoats($locale, $type)
    {
        $boats = Boat::with(['dimensions', 'boatRanges', 'translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->where('category', 'LIKE', '%' . $type . '%')->paginate(12);
        return $this->retrieveResponse(data: BoatResource::collection($boats));
    }

    public function getUsedBoats($locale)
    {
        $boats = Boat::with(['dimensions', 'boatRanges', 'translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->where('condition', 'used')->paginate(12);
        return $this->retrieveResponse(data: BoatResource::collection($boats));
    }

    public function show($locale, $id)
    {
        $boat = Boat::with(['dimensions', 'boatRanges', 'translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->whereId($id)->firstOrFail();
        return $this->retrieveResponse(data: BoatResource::make($boat));
    }
}
