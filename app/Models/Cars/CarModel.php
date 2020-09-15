<?php

namespace App\Models\Cars;

use App\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @property int id
 * @property int make_id
 * @property string name
 * @property CarMake manufacturer
 *
 * @method static Builder|self query()
 * @method static self make(array $attributes = [])
 * @method static self create(array $attributes = [])
 */
class CarModel extends BaseModel
{
    const TABLE_NAME = 'car_models';

    public $timestamps = null;

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
    ];

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(CarMake::class, 'make_id', 'id');
    }
}
