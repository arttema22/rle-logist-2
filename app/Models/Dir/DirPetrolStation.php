<?php

namespace App\Models\Dir;

use Illuminate\Database\Eloquent\Model;

class DirPetrolStation extends Model
{
    protected $fillable = [
        'title',
        'comment',
        'status',
    ];
}
