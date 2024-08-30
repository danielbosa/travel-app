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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(travels $travels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, travels $travels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(travels $travels)
    {
        //
    }
}
