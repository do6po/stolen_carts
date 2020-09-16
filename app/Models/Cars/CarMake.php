<?php

namespace App\Models\Cars;

use App\Core\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * @property int id
 * @property string name
 * @property int remote_id
 * @property null|Carbon created_at
 * @property null|Carbon updated_at
 * @property Collection|CarModel[] models
 *
 * @method static Builder|self query()
 * @method static self make(array $attributes = [])
 * @method static self create(array $attributes = [])
 * @method static Collection|self[] get(array $attributes = [])
 */
class CarMake extends BaseModel
{
    const TABLE_NAME = 'car_makes';

    public $timestamps = null;

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
        'remote_id',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class, 'make_id', 'id');
    }

}
