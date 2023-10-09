<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    //Funzione che mi restituisce le statistiche e mi dice quante sono:
    public function index()
    {
        $statistics = Statistic::all();
        $total = count($statistics);
        return response()->json(compact('statistics', 'total'));
    }
}
