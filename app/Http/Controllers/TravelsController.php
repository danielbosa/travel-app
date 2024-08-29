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
    public function show(travels $travels)
    {
        //
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
