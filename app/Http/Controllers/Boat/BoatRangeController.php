<?php

namespace App\Http\Controllers\Boat;

use App\Models\Boat;
use App\Models\BoatRange;
use App\Http\Requests\Admin\BoatRangeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoatRangeController extends Controller
{
    /**
     * Show the form for creating a new BoatRange.
     *
     * @param Boat $boat
     * @return \Illuminate\Http\Response
     */
    public function create(Boat $boat)
    {
        return view('boats.boat_ranges.edit', compact('boat'));
    }

    /**
     * Store a newly created BoatRange in storage.
     *
     * @param BoatRangeRequest $request
     * @param Boat $boat
     * @return \Illuminate\Http\Response
     */
    public function store(BoatRangeRequest $request, Boat $boat)
    {
        $validatedData = $request->validated();
        $boat->boatRanges()->create($validatedData);

        return redirect()->route('boats.edit', $boat->id)
            ->with('success', 'Gamme ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified BoatRange.
     *
     * @param Boat $boat
     * @param BoatRange $boatRange
     * @return \Illuminate\Http\Response
     */
    public function edit(Boat $boat, $boatRangeId)
    {
        $boatRange = BoatRange::findOrFail($boatRangeId);
        return view('boats.boat_ranges.edit', compact('boat', 'boatRange'));
    }

    /**
     * Update the specified BoatRange in storage.
     *
     * @param BoatRangeRequest $request
     * @param Boat $boat
     * @param BoatRange $boatRange
     * @return \Illuminate\Http\Response
     */
    public function update(BoatRangeRequest $request, Boat $boat, $boatRangeId)
    {
        $boatRange = BoatRange::findOrFail($boatRangeId);
        $validatedData = $request->validated();
        $boatRange->update($validatedData);

        return redirect()->route('boats.edit', $boat->id)
            ->with('success', 'Gamme modifiée avec succès.');
    }

    /**
     * Remove the specified BoatRange from storage.
     *
     * @param Boat $boat
     * @param BoatRange $boatRange
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boat $boat, $boatRangeId)
    {
        $boatRange = BoatRange::findOrFail($boatRangeId);
        $boatRange->delete();

        return redirect()->route('boats.edit', $boat->id)
            ->with('success', 'Gamme supprimée avec succès.');
    }
}
