<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all apartments
        $apartments = Apartment::where('is_visible', true)
            ->orderBy('updated_at', 'DESC')
            ->get();

        // Send response
        return response()->json($apartments);
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
    public function show(string $id)
    {
        $apartment = Apartment::with('user', 'category', 'services')->find($id);
        if (!$apartment) return response(null, 404);
        return response()->json($apartment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Filter the specified resource
     */
    public function filterApartments($filters)
    {
    }
}
