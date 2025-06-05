<?php

namespace App\Models\Setup;

use App\Models\Setup\SetupTariff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SetupTypeTruck extends Model
{
    protected $table = 'dir_type_trucks';

    public function tariffs(): HasMany
    {
        return $this->hasMany(SetupTariff::class, 'dir_type_truck_id');
    }

    public function trucks()
    {
        return $this->hasMany(Truck::class);
    }
}
