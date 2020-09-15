<?php

namespace App\Models;

use App\Core\Models\BaseModel;

class Car extends BaseModel
{
    const TABLE_NAME = 'cars';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
        'registration_plate',
        'color',
        'make',
        'model',
        'year',
    ];
}
