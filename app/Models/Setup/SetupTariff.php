<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SetupTariff extends Model
{
    protected $table = 'dir_tariffs';

    public function typetruck(): BelongsTo
    {
        return $this->belongsTo(SetupTypeTruck::class, 'dir_type_truck_id');
    }
}
