<?php

namespace App\Models;

use App\Models\Setup\SetupTypeTruck;
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
        return $this->belongsTo(SetupTypeTruck::class, 'type_truck_id', 'id');
    }
}
