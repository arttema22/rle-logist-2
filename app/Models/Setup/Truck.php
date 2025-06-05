<?php

namespace App\Models\Setup;

use App\Models\Refilling;
use App\Models\Dir\DirTruckBrand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Truck extends Model
{
    use HasFactory, SoftDeletes, MassPrunable;

    protected $fillable = [
        'reg_num_ru',
        'reg_num_en',
        'brand_id',
        'type_id',
        'is_driver',
        'name'
    ];

    /**
     * driver
     *
     * @return BelongsTo
     */


    /**
     * refillings
     * Получить данные о заправках.
     * @return HasMany
     */
    public function refillings(): HasMany
    {
        return $this->hasMany(Refilling::class, 'truck_id', 'id');
    }

    /**
     * Получить бренд, которому принадлежит автомобиль.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(DirTruckBrand::class, 'brand_id', 'id');
    }

    /**
     * Получить тип, которому принадлежит автомобиль.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(SetupTypeTruck::class, 'type_id', 'id');
    }

    public function driver()
    {
        return $this->hasOne(User::class, 'truck_id');
    }

    /**
     * prunable
     * Запрос для удаления устаревших записей модели.
     * @return Builder
     */
    // public function prunable(): Builder
    // {
    //     return static::where('deleted_at', '<=', now()->subDay());
    // }
}
