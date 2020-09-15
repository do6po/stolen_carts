<?php

namespace App\Models\Cars;

use App\Core\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property null|Carbon created_at
 * @property null|Carbon updated_at
 */
class CarMake extends BaseModel
{
    const TABLE_NAME = 'car_makes';

    public $timestamps = null;

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];

    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }

}
