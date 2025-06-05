<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Setup\User;
use App\Models\Dir\DirCargo;
use App\Models\Dir\DirPayer;
use App\Models\Setup\SetupTypeTruck;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Route extends Model
{
    protected $fillable = [
        'date',
        'owner_id',
        'driver_id',
        'dir_type_trucks_id',
        'cargo_id',
        'payer_id',
        'address_loading',
        'address_unloading',
        'route_length',
        'price_route',
        'number_trips',
        'unexpected_expenses',
        'summ_route',
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

    public function typeTruck()
    {
        return $this->belongsTo(SetupTypeTruck::class, 'dir_type_trucks_id');
    }

    public function cargo()
    {
        return $this->belongsTo(DirCargo::class);
    }

    public function payer()
    {
        return $this->belongsTo(DirPayer::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
