<?php

namespace App\Models\Cars;

use App\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int make_id
 * @property string name
 * @property CarMake make
 */
class CarModel extends BaseModel
{
    const TABLE_NAME = 'car_models';

    public $timestamps = null;

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
    ];

    public function make(): BelongsTo
    {
        return $this->belongsTo(CarMake::class, 'make_id', 'id');
    }
}
