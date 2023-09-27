<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Models\Apartment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Apartments api routes
Route::apiResource('apartments', ApartmentController::class);

// Categories api
Route::get('/categories',  function () {
    $categories = Category::all();
    return response()->json($categories);
});
