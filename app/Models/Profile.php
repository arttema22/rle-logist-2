<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
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
