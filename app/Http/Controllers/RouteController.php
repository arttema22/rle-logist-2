<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::where('driver_id', Auth::user()->id)
            ->where('profit_id', 0)
            ->with('driver')
            //->with('log')
            ->orderByDesc('date')
            ->get();
        return view('route.index', ['routes' => $routes]);
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
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
