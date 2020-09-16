<?php

namespace App\Models\StolenCars;

use App\Core\Models\BaseModel;
use App\Core\Traits\Filterable;
use App\Filters\StolenCars\StolenCarsFilter;
use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int model_id
 * @property string name
 * @property string vin
 * @property string registration_plate
 * @property string color
 * @property string year
 * @property null|Carbon created_at
 * @property null|Carbon updated_at
 * @property CarModel model
 *
 * @method static Builder|self query()
 * @method static Builder|self findOrFail(int $id)
 * @method static self make(array $attributes = [])
 * @method static self create(array $attributes = [])
 *
 * @see Car::scopeJoinModels()
 * @method static Builder|self joinModels()
 *
 * @see Car::scopeJoinMakes()
 * @method static Builder|self joinMakes()
 */
class Car extends BaseModel
{
    use Filterable;

    const TABLE_NAME = 'cars';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
        'registration_plate',
        'color',
        'vin',
        'year',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'model_id', 'id');
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function modelFilter()
    {
        return $this->provideFilter(StolenCarsFilter::class);
    }

    public function scopeJoinModels(Builder $builder)
    {
        $builder->join(
            CarModel::TABLE_NAME,
            CarModel::TABLE_NAME . '.id',
            '=',
            self::TABLE_NAME . '.model_id'
        );
    }

    /**
     * @param Builder|self $builder
     */
    public function scopeJoinMakes(Builder $builder)
    {
        $builder->joinModels()
            ->join(
                CarMake::TABLE_NAME,
                CarMake::TABLE_NAME . '.id',
                '=',
                CarModel::TABLE_NAME . '.make_id'
            );
    }
}
