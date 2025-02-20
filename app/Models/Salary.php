<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    //use HasChangeLog;

    protected $fillable = [
        'date',
        'owner_id',
        'driver_id',
        'salary',
        'profit_id',
        'comment',
        'status',
    ];

    public function getFormatDateAttribute()
    {
        return Carbon::parse($this->date)->format(config('app.date_format'));
    }

    // protected function createdAt(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn(string $value) => Carbon::parse($value)
    //             ->format(config('app.date_full_format')),
    //     );
    // }

    // protected function updatedAt(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn(string $value) => Carbon::parse($value)
    //             ->format(config('app.date_full_format')),
    //     );
    // }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function log(): HasMany
    {
        return $this->hasMany(Activity::class, 'subject_id')
            ->where('log_name', 'salary');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['date', 'salary', 'comment'])
            ->useLogName('salary');
    }
}
