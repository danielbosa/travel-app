<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
//to check auth user (if logged in)
use Illuminate\Support\Facades\Auth; 

class TravelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get travels for current user
        $userId = Auth::id();
        $travels = Travel::where('user_id', $userId)->get();

        // travels to view.blade
        return view('admin.travels.index', ['travels' => $travels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.travels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione dei dati del form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'image' => 'nullable|image|max:2048' // Limita la dimensione a 2MB e solo formati immagine
        ]);

        // Caricamento dell'immagine
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('travel_images', 'public'); // Salva nel disco pubblico
        }

        // Creazione del nuovo viaggio
        Travel::create([
            'user_id' => Auth::id(), // Associa il viaggio all'utente corrente
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'image' => $imagePath
        ]);

        // Reindirizzamento alla lista dei viaggi con messaggio di successo
        return redirect()->route('travels.index')->with('success', 'Viaggio creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Recupera il viaggio con giorni e tappe
        $travel = Travel::with(['days.stops.location', 'days.stops.stop_images'])->findOrFail($id);

        // Verifica che il viaggio appartenga all'utente corrente
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso negato');
        }

        // Calcola la percentuale di completamento per ciascun giorno
        foreach ($travel->days as $day) {
            $totalStops = $day->stops->count();
            $completedStops = $day->stops->where('visited', 1)->count();
            $completionPercentage = $totalStops > 0 ? ($completedStops / $totalStops) * 100 : 0;
            $day->completionPercentage = intval($completionPercentage);
        }

        // Debug: Verifica i dati delle coordinate
        foreach ($travel->days as $day) {
            foreach ($day->stops as $stop) {
                logger()->info('Stop Data:', [
                    'lat' => $stop->location->lat,
                    'lng' => $stop->location->lng,
                ]);
            }
        }

        // Passa i dati alla vista
        return view('admin.travels.show', ['travel' => $travel]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Recupera il viaggio da modificare
        $travel = Travel::findOrFail($id);

        // Verifica che il viaggio appartenga all'utente corrente
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso negato');
        }

        // Passa il viaggio alla vista di modifica
        return view('admin.travels.edit', ['travel' => $travel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Recupera il viaggio da aggiornare
        $travel = Travel::findOrFail($id);

        // Verifica che il viaggio appartenga all'utente corrente
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso negato');
        }

        // Validazione dei dati del form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'image' => 'nullable|image|max:2048' // Limita la dimensione a 2MB e solo formati immagine
        ]);

        // Caricamento dell'immagine
        $imagePath = $travel->image; // Mantieni il percorso dell'immagine esistente
        if ($request->hasFile('image')) {
            // Elimina l'immagine precedente, se esiste
            if ($imagePath) {
                \Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('travel_images', 'public');
        }

        // Aggiornamento del viaggio
        $travel->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'image' => $imagePath
        ]);

        // Reindirizzamento alla lista dei viaggi con messaggio di successo
        return redirect()->route('travels.index')->with('success', 'Viaggio aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Recupera il viaggio da eliminare
        $travel = Travel::findOrFail($id);

        // Verifica che il viaggio appartenga all'utente corrente
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso negato');
        }

        // Elimina l'immagine, se esiste
        if ($travel->image) {
            \Storage::disk('public')->delete($travel->image);
        }

        // Elimina il viaggio
        $travel->delete();

        // Reindirizzamento alla lista dei viaggi con messaggio di successo
        return redirect()->route('travels.index')->with('success', 'Viaggio eliminato con successo!');
    }
}
