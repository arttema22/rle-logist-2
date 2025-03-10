<?php

namespace App\Models;

use Carbon\Carbon;
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
        'integration_id',
        'profit_id',
        'comment',
        'status',
    ];

    public function getFormatDateAttribute()
    {
        return Carbon::parse($this->date)->format(config('app.date_format'));
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format(config('app.date_full_format'));
    }

    public function getUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->format(config('app.date_full_format'));
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function petrolStation()
    {
        return $this->belongsTo(DirPetrolStation::class, 'petrol_stations_id', 'id');
    }
}
