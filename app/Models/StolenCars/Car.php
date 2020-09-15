<?php

namespace App\Models\StolenCars;

use App\Core\Models\BaseModel;
use App\Models\Cars\CarModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

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
 * @method static self make(array $attributes = [])
 * @method static self create(array $attributes = [])
 */
class Car extends BaseModel
{
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

}
