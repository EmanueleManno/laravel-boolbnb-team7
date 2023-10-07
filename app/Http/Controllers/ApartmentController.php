<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use App\Models\Apartment;
use App\Models\Promotion;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get only user apartments
        $apartments = Apartment::where('user_id', Auth::id())
            ->withMax(['promotions' => function ($query) {
                $query->where('apartment_promotion.end_date', '>=', date("Y-m-d H:i:s"));
            }], 'apartment_promotion.end_date')
            ->orderBy('promotions_max_apartment_promotionend_date', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

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
                'rooms' => 'required|integer|min:1',
                'beds' => 'required|integer|min:1',
                'bathrooms' => 'required|integer|min:1',
                'square_meters' => 'nullable|integer|min:0',
                'image' => 'nullable|image:jpg, jpeg, png, svg, webp, pdf',
                'address' => 'required|string',
                'latitude' => 'required|decimal:0,6',
                'longitude' => 'required|decimal:0,6',
                'is_visible' => 'nullable|boolean',
                'category_id' => 'nullable|exists:categories,id',
                'services' => 'required|exists:services,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo non è valido',

                'description.string' => 'La descrizione non è valida',

                'price.required' => 'Non può esistere un appartamento senza prezzo',
                'price.decimal' => 'Il prezzo deve essere un numero con massimo 2 cifre',
                'price.min' => 'Inserisci un prezzo maggiore di zero',

                'rooms.required' => 'Il numero di stanze è obbligatorio',
                'rooms.integer' => 'Inserisci un numero valido',
                'rooms.min' => 'Inserisci un numero maggiore di uno',

                'beds.required' => 'Il numero di letti è obbligatorio',
                'beds.integer' => 'Inserisci un numero valido',
                'beds.min' => 'Inserisci un numero maggiore di uno',

                'bathrooms.required' => 'Il numero di bagni è obbligatorio',
                'bathrooms.integer' => 'Inserisci un numero valido',
                'bathrooms.min' => 'Inserisci un numero maggiore di uno',

                'square_meters.integer' => 'Inserisci un numero valido',
                'square_meters.min' => 'Inserisci un numero maggiore di zero',

                'address.required' => 'L\'indirizzo è obbligatorio',
                'address.string' => 'L\'indirizzo non è valido',

                'image.image' => "l\'immagine inserita non è valida",

                'is_visible.boolean' => 'Il valore non è valido',

                'category_id.exists' => "La categoria è inesistente",

                'services.required' => 'Inserisci almeno un servizio',
                'services.exists' => 'Il servizio è inesistente',
            ]
        );

        // Handle toggle
        $data['is_visible'] = Arr::exists($data, 'is_visible');

        // Insert Apartment
        $apartment = new Apartment();

        // Storage image
        if (array_key_exists('image', $data)) {
            $extension = $data['image']->extension();
            $img_url = Storage::putFile('apartments_img', $data['image']);
            $data['image'] = $img_url;
        }

        $apartment->fill($data);


        // add user to apartment
        $apartment->user_id = Auth::id();

        // Save apartment
        $apartment->save();

        // Insert apartment-service records
        if (Arr::exists($data, 'services')) $apartment->services()->attach($data['services']);

        return to_route('admin.apartments.index')->with('alert-message', 'Appartamento creato con successo')->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if (
            Auth::id() !== $apartment->user_id //&& ($apartment->is_visible === 0)
        ) {
            return to_route('admin.apartments.index')->with('alert-type', 'warning')->with('alert-message', 'Non sei autorizzato!');
        }

        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {

        if (Auth::id() !== $apartment->user_id) {
            return to_route('admin.apartments.show', $apartment)->with('alert-type', 'warning')->with('alert-message', 'Non sei autorizzato!');
        }

        $categories = Category::select('id', 'name')->get();
        $services = Service::select('id', 'name')->get();
        $apartment_service_id = $apartment->services->pluck('id')->toArray();
        return view('admin.apartments.edit', compact('apartment', 'categories', 'services', 'apartment_service_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        // Validazione
        $data = $request->validate(
            [
                'title' => 'required|string', Rule::unique('apartments')->ignore($apartment),
                'description' => 'nullable|string',
                'price' => 'required|decimal:0,2|min:0',
                'rooms' => 'required|integer|min:1',
                'beds' => 'required|integer|min:1',
                'bathrooms' => 'required|integer|min:1',
                'square_meters' => 'nullable|integer|min:0',
                'image' => 'nullable|image:jpg, jpeg, png, svg, webp, pdf',
                'address' => 'required|string',
                'latitude' => 'required|decimal:0,6',
                'longitude' => 'required|decimal:0,6',
                'is_visible' => 'nullable|boolean',
                'category_id' => 'nullable|exists:categories,id',
                'services' => 'required|exists:services,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo non è valido',

                'description.string' => 'La descrizione non è valida',

                'price.required' => 'Non può esistere un appartamento senza prezzo',
                'price.decimal' => 'Il prezzo deve essere un numero con massimo 2 cifre',
                'price.min' => 'Inserisci un prezzo maggiore di zero',

                'rooms.required' => 'Il numero di stanze è obbligatorio',
                'rooms.integer' => 'Inserisci un numero valido',
                'rooms.min' => 'Inserisci un numero maggiore di uno',

                'beds.required' => 'Il numero di letti è obbligatorio',
                'beds.integer' => 'Inserisci un numero valido',
                'beds.min' => 'Inserisci un numero maggiore di uno',

                'bathrooms.required' => 'Il numero di bagni è obbligatorio',
                'bathrooms.integer' => 'Inserisci un numero valido',
                'bathrooms.min' => 'Inserisci un numero maggiore di uno',

                'square_meters.integer' => 'Inserisci un numero valido',
                'square_meters.min' => 'Inserisci un numero maggiore di zero',

                'address.required' => 'L\'indirizzo è obbligatorio',
                'address.string' => 'L\'indirizzo non è valido',

                'image.image' => "l\'immagine inserita non è valida",

                'is_visible.boolean' => 'Il valore non è valido',

                'category_id.exists' => "La categoria è inesistente",

                'services.required' => 'Inserisci almeno un servizio',
                'services.exists' => 'Il servizio è inesistente',
            ]
        );

        // Storage image
        if (Arr::exists($data, 'image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $img_url = Storage::putFile('apartments_img', $data['image']);
            $data['image'] = $img_url;
        } elseif (Arr::exists($request, 'delete_image') && $apartment->image) {
            Storage::delete($apartment->image);
            $data['image'] = null;
        }

        if (Arr::exists($data, 'services')) $apartment->services()->sync($data['services']);

        // Handle toggle
        $data['is_visible'] = Arr::exists($data, 'is_visible');

        $apartment->update($data);

        return to_route('admin.apartments.index')->with('alert-type', 'primary')->with('alert-message', "L'appartamento $apartment->title è stato modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Apartment::destroy($id);

        return to_route('admin.apartments.index')->with('alert-message', 'Appartamento eliminato con successo')->with('alert-type', 'danger');
    }

    //Funzione per il cestino:
    public function trash()
    {
        // Get only user apartments
        $apartments = Apartment::onlyTrashed()->where('user_id', Auth::id())->paginate(5);

        return view('admin.apartments.trash', compact('apartments'));
    }

    //Funzione per il restore:
    public function restore(string $id)
    {
        $apartment = Apartment::onlyTrashed()->findOrFail($id);
        $apartment->restore();

        return to_route('admin.apartments.trash')->with('alert-message', "L'appartamento $apartment->title è stato ripristinato con successo")->with('alert-type', 'success');
    }

    //Funzione per il drop:
    public function drop(string $id)
    {
        $apartment = Apartment::onlyTrashed()->findOrFail($id);

        $apartment->forceDelete();

        return to_route('admin.apartments.trash')->with('alert-message', "L'appartamento $apartment->title è stato eliminato definitivamente")->with('alert-type', 'danger');
    }

    //Funzione per il dropAll:
    public function dropAll()
    {
        $total = Apartment::onlyTrashed()->where('user_id', Auth::id())->count();

        Apartment::onlyTrashed()->where('user_id', Auth::id())->forceDelete();

        if ($total === 0) {
            return to_route('admin.apartments.trash')->with('alert-message', "Non ci sono appartamenti da eliminare")->with('alert-type', 'danger');
        }

        return to_route('admin.apartments.trash')->with('alert-message', "Sono stati eliminati $total appartamenti")->with('alert-type', 'danger');
    }


    /**
     * Toggle Apartment visibility.
     */
    public function toggle(Apartment $apartment)
    {
        $apartment->is_visible = !$apartment->is_visible;
        $action = $apartment->is_visible ? 'pubblicato' : 'salvato come bozza';
        $apartment->save();

        return to_route('admin.apartments.show', $apartment)->with('alert-message', "Appartamento $action.")->with('alert-type', 'info');
    }


    /**
     * 
     */
    public function promote(Request $request, Apartment $apartment)
    {


        $promotions = Promotion::all();

        $gateway = new \Braintree\Gateway(config('braintree'));

        if ($request->input('payment_method_nonce') != null) {

            $promotion_id = $request->input('promotion');
            $promotion = Promotion::find($promotion_id);

            $nonceFromTheClient = $request->input('payment_method_nonce');
            $result = $gateway->transaction()->sale([
                'amount' => $promotion->price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            if ($result->success) {

                $data = $request->all();

                $start_date = now()->format('Y-m-d H:i:s');
                $end_date = date('Y-m-d H:i:s', strtotime("+ $promotion->duration hours"));

                $apartment->promotions()->attach($request['promotion'], ['start_date' => $start_date, 'end_date' => $end_date]);

                return to_route('admin.apartments.index')->with('alert-message', "Il pagamento è andato a buon fine.")->with('alert-type', 'success');
            } else {
                return to_route('admin.apartments.index')->with('alert-message', "Il pagamento non è andato a buon fine.")->with('alert-type', 'danger');
            }
        }

        $clientToken = $gateway->clientToken()->generate();
        return view('admin.apartments.promote', compact('clientToken', 'apartment', 'promotions'));
    }
}
