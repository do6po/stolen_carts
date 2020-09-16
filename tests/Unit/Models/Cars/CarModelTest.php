<?php

namespace Unit\Models\Cars;

use App\Models\Cars\CarModel;
use App\Models\Cars\CarMake;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarModelTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_create_car()
    {
        /** @var CarMake $make */
        $make = factory(CarMake::class)->create();

        $attributes = [
            'name' => 'A6',
            'remote_id' => 1000,
        ];

        $this->notSeeInDatabase(CarModel::TABLE_NAME, $attributes);

        $car = CarModel::query()->make($attributes);
        $car->make_id = $make->id;
        $car->save();

        $this->seeInDatabase(CarModel::TABLE_NAME, $attributes);
    }

}
