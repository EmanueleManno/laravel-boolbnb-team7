<?php

// Home
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ViewController;
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


    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index'); // message index
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create'); //! message create
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store'); //! message store

    // Statistics
    Route::get('/statistics', [ViewController::class, 'index'])->name('statistics.index'); // statistics index 
    // Statistics prova di importazione grafico
    Route::get('/statistics/{apartment}/graph', [ApartmentController::class, 'statistics'])->name('statistics.index2'); // statistics index2 

    // Apartments
    Route::get('apartments/trash', [ApartmentController::class, 'trash'])->name('apartments.trash'); // Trash index
    Route::patch('/apartments/{apartment}/restore', [ApartmentController::class, 'restore'])->name('apartments.restore'); // Trash restore
    //Route::delete('apartments/drop', [ApartmentController::class, 'dropAll'])->name('apartments.dropAll'); //! Trash Drop
    //Route::delete('apartments/{apartment}/drop', [ApartmentController::class, 'drop'])->name('apartments.drop');//! Trash Drop All

    Route::patch('/apartments/{apartment}/toggle', [ApartmentController::class, 'toggle'])->name('apartments.toggle'); // toggle

    Route::get('/apartments/{apartment}/promote', [ApartmentController::class, 'promote'])->name('apartments.promote'); // promote
    Route::get('/apartments/premium', [ApartmentController::class, 'premium'])->name('apartments.premium'); // boolbnb premium
    Route::post('/apartments/{apartment}/sponsorize', [ApartmentController::class, 'sponsorize'])->name('apartments.sponsorize'); // sponsorize

    Route::resource('apartments', ApartmentController::class); // CRUD
});


// Auths
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
