<?php

namespace Unit\Models\Cars;

use App\Models\Cars\CarMake;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarMakeTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_create_new_car_make()
    {
        $attributes = [
            'name' => $this->faker()->name,
            'remote_id' => 100,
        ];

        $this->notSeeInDatabase(CarMake::TABLE_NAME, $attributes);

        CarMake::query()->create($attributes);

        $this->seeInDatabase(CarMake::TABLE_NAME, $attributes);
    }

    public function test_create_new_car_make_from_factory()
    {
        $attributes = [
            'name' => $this->faker()->name,
            'remote_id' => 100,
        ];

        $this->notSeeInDatabase(CarMake::TABLE_NAME, $attributes);

        factory(CarMake::class)->create($attributes);

        $this->seeInDatabase(CarMake::TABLE_NAME, $attributes);
    }
}
