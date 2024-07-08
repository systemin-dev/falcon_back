<?php


namespace App\Http\Controllers\Boat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BoatRequest;
use App\Models\Boat;
use App\Models\BoatTranslation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = App::currentLocale();
        $boats = Boat::with([
            'dimensions',
            'boatRanges',
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])->latest()->paginate(10);

        return view('boats.index', compact('boats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = config('app.langages');
        return view('boats.edit', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\BoatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoatRequest $request)
    {
        $boat_data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/boats');
            $boat_data['image'] = $imagePath;
        }

        $boat = Boat::create($boat_data);

        foreach ($request['translations'] as $locale => $translationData) {
            BoatTranslation::create([
                'boat_id' => $boat->id,
                'locale' => $locale,
                'description' => $translationData['description'],
                'base' => $translationData['base'],
                'construction_type' => $translationData['construction_type'],
                'flat_board' => $translationData['flat_board'],
            ]);
        }

        return redirect()->route('boats.edit', ['boat' => $boat])->with('success', 'Bateau ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Boat  $boat
     * @return \Illuminate\Http\Response
     */
    public function edit(Boat $boat)
    {
        $locales = config('app.langages');
        return view('boats.edit', compact('boat', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\BoatRequest  $request
     * @param  \App\Models\Boat  $boat
     * @return \Illuminate\Http\Response
     */
    public function update(BoatRequest $request, Boat $boat)
    {
        $boat_data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            Storage::delete($boat->image);
            $imagePath = $request->file('image')->store('images/boats');
            $boat_data['image'] = $imagePath;
        }

        $boat->update($boat_data);

        foreach ($request['translations'] as $locale => $translationData) {
            $boatTranslation = $boat->translations()->where('locale', $locale)->first();

            if ($boatTranslation) {
                $boatTranslation->update($translationData);
            } else {
                BoatTranslation::create([
                    'boat_id' => $boat->id,
                    'locale' => $locale,
                    'description' => $translationData['description'],
                    'base' => $translationData['base'],
                    'construction_type' => $translationData['construction_type'],
                    'flat_board' => $translationData['flat_board'],
                ]);
            }
        }

        return redirect()->route('boats.index')->with('success', 'Bateau modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Boat  $boat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boat $boat)
    {
        if ($boat->image != null) {
            Storage::delete($boat->image);
        }
        $boat->delete();

        return redirect()->route('boats.index')->with('success', 'Bateau supprimé avec succès.');
    }
}
