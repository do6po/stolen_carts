<?php

namespace App\Models;

use App\Core\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property null|Carbon created_at
 * @property null|Carbon updated_at
 */
class Make extends BaseModel
{
    const TABLE_NAME = 'makes';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
