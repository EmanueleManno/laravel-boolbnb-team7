<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Filter apartments resource
     */
    public function index(Request $request)
    {

        //*** FILTERS DATA ***//
        $filters = $request->all();
        $radius = $filters['radius'] ?? 20000;

        // Check Required parameters
        if (!isset($filters['lat']) || !isset($filters['lon'])) return response(400);


        //*** GET APARTMENTS WITH FILTERS ***//
        // Get apartments fields and calculate distance
        $query = Apartment::selectRaw("*, ST_Distance_Sphere(POINT({$filters['lon']}, {$filters['lat']}), POINT( `longitude`, `latitude`)) AS `distance`");

        // Get all visible apartments
        $query->where('is_visible', 1);

        // Filtro "min rooms"
        if (isset($filters['rooms'])) {
            $query->where('rooms', '>=', $filters['rooms']);
        };

        // Filtro "min beds"
        if (isset($filters['beds'])) {
            $query->where('beds', '>=', $filters['beds']);
        };

        // TODO: Filtro "services"

        // Filter by distance and order ASC
        $query->having('distance', '<', $radius);
        $query->orderBy('distance');

        // Apply query and get apartments
        $apartments = $query->get();


        return $apartments;
    }
}
