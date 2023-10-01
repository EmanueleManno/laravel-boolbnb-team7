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
        //*** API DATA ***//
        $api_uri = 'https://api.tomtom.com/search/2/geometryFilter.json';
        $api_key = config('api_config.tt_key');


        //*** GET APARTMENTS WITH FILTERS ***//
        // Get all visible apartments and apply other filters (TODO)
        $apartments = Apartment::where('is_visible', 1)->get();


        //*** SET TOM TOM API PARAMETERS ***//
        $radius = $filters['radius'] ?? 20000; // default 20km
        $request_poi_list = [];

        // Set cirlce geometry
        $request_geometry_list = [
            [
                "type" => "CIRCLE",
                "position" => "{$filters['lat']}, {$filters['lon']}",
                "radius" => $radius
            ]
        ];

        // Set POI List from apartments
        foreach ($apartments as $apartment) {
            $request_poi_list[] = [
                "poi" => [
                    "name" => $apartment['id']
                ],
                "address" => [
                    "freeformAddress" => $apartment['address']
                ],
                "position" => [
                    "lat" => $apartment['latitude'],
                    "lon" => $apartment['longitude']
                ]
            ];
        }


        //*** FETCH API ***//
        $response_poi_list = Http::get($api_uri, [
            'key' => $api_key,
            'geometryList' => json_encode($request_geometry_list),
            'poiList' => json_encode($request_poi_list)
        ]);


        //*** GET FILTERED APARTMENTS ***//
        $filtered_apartments = [];

        foreach ($response_poi_list->json('results') as $poi_data) {
            // Get ID from poi name
            $id = $poi_data['poi']['name'];

            // Find apartment
            $filtered_apartments[] = $apartments->find($id);
        }


        return $filtered_apartments; //! DEBUG
        //return $apartments;
    }
}
