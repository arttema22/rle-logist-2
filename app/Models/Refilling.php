<?php

namespace App\Models;

use App\Models\Dir\DirPetrolStation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refilling extends Model
{
    protected $fillable = [
        'date',
        'owner_id',
        'driver_id',
        'petrol_stations_id',
        'num_liters_car_refueling',
        'price_car_refueling',
        'cost_car_refueling',
        'profit_id',
        'comment',
        'status',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function petrolStation()
    {
        return $this->belongsTo(DirPetrolStation::class, 'petrol_stations_id', 'id');
    }
}
