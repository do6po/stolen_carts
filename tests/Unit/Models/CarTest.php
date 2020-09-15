<?php

namespace Unit\Models;

use App\Models\Car;
use App\Models\Make;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_create_car()
    {
        /** @var Make $make */
        $make = factory(Make::class)->create();

        $attributes = [
            'name' => 'Машина Влада',
            'registration_plate' => 'ВТ0931АМ',
            'color' => 'blue',
            'model' => 'Tarantaika',
            'year' => 1901,
        ];

        $this->notSeeInDatabase(Car::TABLE_NAME, $attributes);

        $car = Car::query()->make($attributes);
        $car->make_id = $make->id;
        $car->save();

        $this->seeInDatabase(Car::TABLE_NAME, $attributes);
    }

}
