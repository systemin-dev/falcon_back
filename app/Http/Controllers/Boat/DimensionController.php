<?php

namespace App\Http\Controllers\Boat;

use App\Http\Requests\Admin\BoatDimensionRequest;
use App\Models\Boat;
use App\Models\Dimension;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DimensionController extends Controller
{
    public function create(Boat $boat)
    {
        return view('boats.dimensions.edit', compact('boat'));
    }

    public function store(BoatDimensionRequest $request, Boat $boat)
    {
        $data = $request->validated();
        $data['boat_type'] = $boat->category;

        $boat->dimensions()->create($data);

        return redirect()->route('boats.edit', $boat->id)
            ->with('success', 'Dimension ajoutée avec succès.');
    }


    public function edit(Boat $boat, Dimension $dimension)
    {
        return view('boats.dimensions.edit', compact('boat', 'dimension'));
    }

    public function update(BoatDimensionRequest $request, Boat $boat, Dimension $dimension)
    {
        $dimension->update($request->validated());
        return redirect()->route('boats.edit', $boat->id)
            ->with('success', 'Dimension mise à jour avec succès.');
    }

    public function destroy(Boat $boat, Dimension $dimension)
    {
        $dimension->delete();
        return redirect()->route('boats.edit', $boat->id)
            ->with('success', 'Dimension supprimée avec succès.');
    }
}
