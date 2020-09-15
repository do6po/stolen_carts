<?php

namespace App\Models;

use App\Core\Models\BaseModel;

class Make extends BaseModel
{
    const TABLE_NAME = 'makes';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];
}
