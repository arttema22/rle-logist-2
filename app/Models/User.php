<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'e1_card',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class,);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'driver_id')->where('profit_id',  0);
    }

    public function refillings()
    {
        return $this->hasMany(Refilling::class, 'driver_id')->where('profit_id',  0);
    }

    public function routes()
    {
        return $this->hasMany(Route::class, 'driver_id')->where('profit_id',  0);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'driver_id')->where('status', 1);
    }

    public function profits()
    {
        return $this->hasMany(Profit::class, 'driver_id');
    }

    public function profit(): HasOne
    {
        return $this->hasOne(Profit::class, 'driver_id')->latestOfMany();
    }
}
