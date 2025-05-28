<?php

namespace App\Models\Dir;

use App\Models\Sys\Truck;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DirTypeTruck extends Model
{
    public function tariffs(): HasMany
    {
        return $this->hasMany(DirTariff::class);
    }

    public function trucks()
    {
        return $this->hasMany(Truck::class);
    }
}
