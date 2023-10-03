<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //Funzione che mi restituisce i messaggi e mi dice quanti sono:
    public function index()
    {
        $messages = Message::all();
        $total = count($messages);
        return response()->json(compact('messages', 'total'));
    }

    public function store(Request $request)

    {

        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'content' => 'required'
            ],
            [
                'name.required' => 'Il titolo è obbligatorio',
                'email.required' => 'La mail è obbligatoria',
                'email.email' => 'La mail non è scritta nel formato giusto',
                'content.required' => 'Il contenuto è obbligatorio'
            ]
        );

        // Insert message
        $message = new Message();

        $message->fill($data);

        // Save apartment
        $message->save();

        return to_route('message.index')->with('alert-message', 'Messaggio creato con successo')->with('alert-type', 'success');
    }
}
