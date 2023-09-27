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

// Guest Home
Route::get('/', [GuestHomeController::class, 'index'])->name('guest.home');

// Admin Home
Route::get('/home', [AdminHomeController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.home');

// Apartments Routes:
Route::patch('/apartments/{apartment}/toggle', [ApartmentController::class, 'toggle'])->middleware(['auth', 'verified'])->name('admin.apartments.toggle');
Route::resource('apartments', ApartmentController::class)->middleware(['auth', 'verified']);

// Auths
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
