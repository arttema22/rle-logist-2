<?php

namespace App\Models\Stat;

use Illuminate\Database\Eloquent\Model;

class StatRoutes extends Model
{
    protected $fillable = [
        'date_from',
        'date_to',
        'count_routes',
        'length_routes',
        'sum_routes',
        'average_sum',
    ];
}
