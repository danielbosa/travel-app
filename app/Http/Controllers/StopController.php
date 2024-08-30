<?php

namespace App\Http\Controllers;

use App\Models\Stop;
use App\Models\Location;
use App\Models\Stop_image;
use Illuminate\Http\Request;

class StopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($travel_id, $day_id)
    {
        return view('admin.stops.create', ['travel_id' => $travel_id, 'day_id' => $day_id]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione dei dati della richiesta
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'name_location' => 'required|string',
            'travel_id' => 'required|exists:travels,id',
            'day_id' => 'required|exists:days,id', // Verifica che il day_id sia valido
        ]);

        // Creazione di una nuova tappa
        $stop = new Stop();
        $stop->name = $request->input('name');
        $stop->description = $request->input('description');
        $stop->day_id = $request->input('day_id'); // Assegna il day_id
        $stop->save();

        // Creazione di una nuova località associata alla tappa, senza verificare se esiste già
        $location = new Location();
        $location->stop_id = $stop->id; // Associa la località alla tappa
        $location->name = $request->input('name_location');
        $location->lat = $request->input('latitude');
        $location->lng = $request->input('longitude');
        $location->save(); // Salva sempre una nuova località

        // Redirect alla vista del viaggio
        return redirect()->route('travels.show', ['id' => $request->input('travel_id')])
                        ->with('success', 'Tappa aggiunta con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stop $stop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stop $stop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stop $stop)
    {
        $stop->visited = $request->input('visited');
        $stop->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stop $stop)
    {
        //
    }

    public function updateNotes(Request $request, Stop $stop)
    {
        $request->validate([
            'notes' => 'string|nullable',
        ]);

        $stop->notes = $request->notes;
        $stop->save();

        return response()->json(['success' => true]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Valida il file immagine
            'stop_id' => 'required|exists:stops,id', // Verifica che l'ID della tappa esista
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/stop_images'), $imageName);

        // Salva l'immagine nel database
        $stopImage = new Stop_image(); 
        $stopImage->stop_id = $request->stop_id;
        $stopImage->image_path = $imageName;
        $stopImage->save();

        return response()->json(['success' => true, 'image' => $stopImage]);
    }

    public function updateRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $stop = Stop::findOrFail($id);
        $stop->vote = $request->input('rating');
        $stop->save();

        return response()->json(['success' => true]);
    }

}
