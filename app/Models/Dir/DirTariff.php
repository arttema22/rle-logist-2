<?php

namespace App\Models\Dir;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirTariff extends Model
{
    public function typetruck(): BelongsTo
    {
        return $this->belongsTo(DirTypeTruck::class, 'dir_type_truck_id');
    }
}
