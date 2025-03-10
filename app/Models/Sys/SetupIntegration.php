<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

class SetupIntegration extends Model
{
    protected $fillable = [
        'name',
        'url',
        'user_name',
        'password',
        'additionally',
        'help_api',
        'access_token'
    ];

    protected $casts = [
        'additionally' => 'json',
    ];
}
