<?php

namespace App\Livewire\Route;

use App\Models\Route;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

#[Lazy]
class RouteSmallManager extends Component
{
    use WithoutUrlPagination;

    public $refilling_id, $date, $owner_id, $driver_id, $cost_car_refueling, $comment;
    public $editForm = false, $confirmingDeletion = false;
    public $createOrUpdate;
    public $isOpenForm = false;

    public function render()
    {
        $routes = Route::where('driver_id', Auth::user()->id)
            ->where('profit_id', 0)
            ->with('driver')
            //->with('log')
            ->orderByDesc('date')
            ->take(3)
            ->get();
        return view('livewire.route.route-small-manager', ['routes' => $routes]);
    }
}
