<?php

namespace App\Models;

use App\Models\Setup\SetupService;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function dirService()
    {
        return $this->belongsTo(SetupService::class, 'service_id');
    }
}
