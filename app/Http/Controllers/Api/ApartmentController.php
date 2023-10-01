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
    public function index(Request $request)
    {

        // Get filters
        $filters = $request->all();


        if (isset($filters['lat']) && isset($filters['lon'])) {

            // Get filtered apartments
            $apartments = $this->filterApartments($filters);
        } else {

            // Get all apartments
            $apartments = Apartment::where('is_visible', true)
                ->orderBy('updated_at', 'DESC')
                ->get();
        }

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
        //
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
        // API Data
        $api_uri = 'https://api.tomtom.com/search/2/geometryFilter.json';
        $api_key = config('api_config.tt_key');

        // Get all visible apartments and apply other filters (TODO)
        $apartments = Apartment::where('is_visible', 1)->get();

        // Fetch API
        $response = Http::get($api_uri, [
            'key' => $api_key
        ]);



        return $apartments; //! DEBUG
        //return $apartments;
    }
}
