<?php

namespace App\Models\Stat;

use Illuminate\Database\Eloquent\Model;

class StatSalaries extends Model
{
    protected $fillable = [
        'date_from',
        'date_to',
        'count_salaries',
        'sum_salaries',
        'average_sum',
    ];
}
