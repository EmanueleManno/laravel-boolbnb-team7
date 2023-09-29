<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Models\Apartment;
use App\Models\Category;
use App\Models\Session as ModelsSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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


Route::get('/user', function () {
    $user = ModelsSession::select('user_id')->get();
    $userTarget = User::where('id', '=', $user[0]['user_id'])->get();
    // $user = Session::all();
    return response()->json($userTarget);
});
