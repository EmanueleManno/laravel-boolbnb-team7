<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use App\Models\Apartment;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get only user apartments
        $user = Auth::user();
        $apartments = $user->apartments;

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apartment = new Apartment();
        $categories = Category::select('id', 'name')->get();
        $services = Service::select('id', 'name')->get();

        return view('admin.apartments.create', compact('apartment', 'categories', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $data = $request->validate(
            [
                'title' => 'required|string',
                'description' => 'nullable|string',
                'price' => 'required|decimal:0,2|min:0',
                'rooms' => 'nullable|integer|min:0',
                'beds' => 'nullable|integer|min:0',
                'bathrooms' => 'nullable|integer|min:0',
                'square_meters' => 'nullable|integer|min:0',
                'image' => 'nullable|url',
                'address' => 'nullable|string',
                'latitude' => 'nullable|decimal:0,6',
                'longitude' => 'nullable|decimal:0,6',
                'is_visible' => 'nullable|boolean',
                'category_id' => 'nullable|exists:categories,id',
                'services' => 'nullable|exists:services,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo non è valido',

                'description.string' => 'La descrizione non è valida',

                'price.required' => 'Non può esistere un appartamento senza prezzo',
                'price.decimal' => 'Il prezzo deve essere un numero con massimo 2 cifre',
                'price.min' => 'Inserisci un prezzo maggiore di zero',

                'rooms.integer' => 'Inserisci un numero valido',
                'rooms.min' => 'Inserisci un numero maggiore di zero',

                'beds.integer' => 'Inserisci un numero valido',
                'beds.min' => 'Inserisci un numero maggiore di zero',

                'bathrooms.integer' => 'Inserisci un numero valido',
                'bathrooms.min' => 'Inserisci un numero maggiore di zero',

                'square_meters.integer' => 'Inserisci un numero valido',
                'square_meters.min' => 'Inserisci un numero maggiore di zero',

                'address.string' => 'L\'indirizzo non è valido',

                'image.url' => "Inserisci un url valido",

                'is_visible.boolean' => 'Il valore non è valido',

                'category_id.exists' => "La categoria è inesistente",

                'services.exists' => 'Il servizio è inesistente',
            ]
        );

        // Insert Apartment
        $apartment = new Apartment();
        $apartment->fill($data);

        // add user to apartment
        $apartment->user_id = Auth::id();

        // Save apartment
        $apartment->save();

        // Insert apartment-service records
        if (Arr::exists($data, 'services')) $apartment->services()->attach($data['services']);

        return to_route('apartments.index')->with('alert-message', 'Appartamento creato con successo')->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        return to_route('apartments.index')->with('alert-type', 'primary')->with('alert-message', "L'appartamento $apartment->title è stato modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Apartment::destroy($id);

        return to_route('apartments.index')->with('alert-message', 'Appartamento eliminato con successo')->with('alert-type', 'danger');
    }

    /**
     * Toggle Apartment visibility.
     */
    public function toggle(Apartment $apartment)
    {
        $apartment->is_visible = !$apartment->is_visible;
        $action = $apartment->is_visible ? 'pubblicato' : 'salvato come bozza';
        $apartment->save();

        return to_route('apartments.show', $apartment)->with('alert-message', "Appartamento $action.")->with('alert-type', 'info');
    }
}
