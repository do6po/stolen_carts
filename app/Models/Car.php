<?php

namespace App\Models;

use App\Core\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int make_id
 * @property string name
 * @property string registration_plate
 * @property string color
 * @property string model
 * @property string year
 * @property null|Carbon created_at
 * @property null|Carbon updated_at
 * @property Make make
 */
class Car extends BaseModel
{
    const TABLE_NAME = 'cars';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
        'registration_plate',
        'color',
        'model',
        'year',
    ];

    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class);
    }

}
