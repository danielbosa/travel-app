<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TravelsController;
use App\Http\Controllers\StopController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


//Middlware controlla se l'utente è autenticato e verificato; se sì, allora le rotte vengono eseguite; se no entra in gioco la rotta di fallback che rimanda alla dashboard: ma se non è autenticato, allora viene rimandato alla login (e questo è definito in app/Http/Middleware/Authenticate.php)
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [TravelsController::class, 'index'])->name('mytravels.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //route for mytravels for logged-in
    //Route::get('/mytravels', [TravelsController::class, 'index'])->name('mytravels.index');
    Route::get('/travels/{id}', [TravelsController::class, 'show'])->name('travels.show');

    //route for create travel
    Route::get('travels/create', [TravelsController::class, 'create'])->name('travels.create');

    // Route per memorizzare una nuova tappa
    Route::post('/stops', [StopController::class, 'store'])->name('stops.store');

    // route for updating status "visited" on stops table
    Route::put('/stops/{stop}', [StopController::class, 'update'])->name('stops.update');

    // route for edit notes stops
    Route::post('/stops/{stop}/update-notes', [StopController::class, 'updateNotes']);

    // route for create stops
    Route::get('/stops/create/{travel_id}/{day_id}', [StopController::class, 'create'])->name('stops.create');

    Route::post('/stops/upload-image', [StopController::class, 'uploadImage'])->name('stops.upload-image');




});

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect()->route('home');
});
