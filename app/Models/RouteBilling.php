<?php

namespace App\Models;

use App\Models\DirTypeTrucks;
use App\Models\Dir\DirTypeTruck;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RouteBilling extends Model
{

    use HasFactory;

    /**
     * Получить тип авто, связанный с тарифом.
     */
    public function typeTruck()
    {
        return $this->belongsTo(DirTypeTruck::class, 'type_truck_id', 'id');
    }
}
