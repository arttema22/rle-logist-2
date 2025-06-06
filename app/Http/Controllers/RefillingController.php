<?php

namespace App\Http\Controllers;

use App\Models\Refilling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $refillings = Refilling::where('driver_id', Auth::user()->id)
            ->where('profit_id', 0)
            ->with('driver')
            //->with('log')
            ->orderByDesc('date')
            ->get();
        return view('refilling.index', ['refillings' => $refillings]);
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
    public function show(Refilling $refilling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Refilling $refilling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Refilling $refilling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Refilling $refilling)
    {
        //
    }
}
