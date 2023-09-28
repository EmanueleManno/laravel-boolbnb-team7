<?php

// Home
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApartmentController;
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

    // Apartments Routes:
    //Rotta per il cestino:
    Route::get('apartments/trash', [ApartmentController::class, 'trash'])->name('apartments.trash');
    //Rotta per il restore:
    Route::patch('/apartments/{apartment}/restore', [ApartmentController::class, 'restore'])->name('apartments.restore');
    Route::patch('/apartments/{apartment}/toggle', [ApartmentController::class, 'toggle'])->name('apartments.toggle');
    Route::resource('apartments', ApartmentController::class);
});


// Auths
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
