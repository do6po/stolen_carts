<?php

namespace Unit\Models;

use App\Models\Make;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class MakeTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_new_make()
    {
        $attributes = [
            'name' => $this->faker()->name
        ];

        $this->notSeeInDatabase(Make::TABLE_NAME, $attributes);

        Make::query()->create($attributes);

        $this->seeInDatabase(Make::TABLE_NAME, $attributes);
    }
}
