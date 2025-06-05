<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'sec_name',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name} {$this->sec_name}";
    }

    public function getSurnameInitialsAttribute()
    {
        $fname = strtoupper(mb_substr($this->first_name, 0, 1));
        $sname = strtoupper(mb_substr($this->sec_name, 0, 1));
        return "{$this->last_name} $fname.$sname.";
    }
}
