<?php

namespace App\Models\Dir;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DirTypeTruck extends Model
{
    public function tariffs(): HasMany
    {
        return $this->hasMany(DirTariff::class);
    }
}
