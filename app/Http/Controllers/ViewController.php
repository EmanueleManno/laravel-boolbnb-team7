<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $views = View::whereRelation('apartment', 'user_id', Auth::id())->get();

        return view('admin.statistics.index', compact('views'));
    }

    public function index2()
    {
        $views = View::whereRelation('apartment', 'user_id', Auth::id())->get();

        return view('admin.statistics.index2', compact('views'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(view $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, view $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(view $view)
    {
        //
    }
}
