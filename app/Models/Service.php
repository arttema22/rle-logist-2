<?php

namespace App\Models;

use App\Models\Dir\DirService;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function dirService()
    {
        return $this->belongsTo(DirService::class, 'service_id');
    }
}
