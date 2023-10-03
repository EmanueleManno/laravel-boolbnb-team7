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

    //Funzione che mi restituisce i messaggi filtrati per id dell'appartamento:
    public function filtermessages()
    {
        //Prendi i messaggi con id dell'appartamento uguale a 1:
        $messages = Message::all()->where('apartment_id', 1);

        //Mandami la risposta:
        $total = count($messages);
        return response()->json(compact('messages', 'total',));
    }
}
