<?php

namespace App\Models\Stat;

use Illuminate\Database\Eloquent\Model;

class StatRefilling extends Model
{
    protected $fillable = [
        'date_from',
        'date_to',
        'count_refillings',
        'count_liters',
        'sum_refillings',
        'average_price_liter',
    ];
}
