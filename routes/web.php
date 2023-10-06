<?php

// Home
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Models\Category;
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

// Guest Home (Redirect su Vue)
Route::get('/', [GuestHomeController::class, 'index'])->name('guest.home');

// Admin Routes
Route::prefix('/admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {

    // Home
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');

    // Rotte per i messaggi
    //Lista di tutti i messaggi:
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    //Creazione di un messaggio:
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    //Store di un messaggio:
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // Apartments Routes:
    //Rotta per il cestino:
    Route::get('apartments/trash', [ApartmentController::class, 'trash'])->name('apartments.trash');
    //Rotta per il restore:
    Route::patch('/apartments/{apartment}/restore', [ApartmentController::class, 'restore'])->name('apartments.restore');
    //Rotta per lo svuota cestino:
    //Route::delete('apartments/drop', [ApartmentController::class, 'dropAll'])->name('apartments.dropAll');
    //Rotta per l'elimina definitivamente:
    //Route::delete('apartments/{apartment}/drop', [ApartmentController::class, 'drop'])->name('apartments.drop');
    //Rotta per il toggle:
    Route::patch('/apartments/{apartment}/toggle', [ApartmentController::class, 'toggle'])->name('apartments.toggle');
    //Rotta per il payment:
    Route::get('/apartments/{apartment}/promote', [ApartmentController::class, 'promote'])->name('apartments.promote');
    Route::post('/apartments/{apartment}/promote', [ApartmentController::class, 'promote'])->name('apartments.payment');

    Route::resource('apartments', ApartmentController::class);
});





// Auths
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
