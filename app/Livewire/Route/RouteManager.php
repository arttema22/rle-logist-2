<?php

namespace App\Livewire\Route;

use App\Models\Route;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RouteManager extends Component
{
    public function render()
    {
        $routes = Route::where('driver_id', Auth::user()->id)
            ->where('profit_id', 0)
            ->with('driver')
            //->with('log')
            ->orderByDesc('date')
            ->get();
        return view('livewire.route.route-manager', ['routes' => $routes]);
    }
}
