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
            'name' => $this->faker()->name,
            'registration_plate' => $this->faker()->randomElement($this->carNumber()),
            'color' => $this->faker()->colorName,
            'model' => $this->faker()->randomElement($this->carModels()),
            'year' => $this->faker()->year,
        ];

        $this->notSeeInDatabase(Car::TABLE_NAME, $attributes);

        $car = Car::query()->make($attributes);
        $car->make_id = $make->id;
        $car->save();

        $this->seeInDatabase(Car::TABLE_NAME, $attributes);
    }

    private function carNumber()
    {
        return [
            'ВТ0931АМ',
            'ВТ3003АМ',
            'ВТ0399АМ',
            'ВТ1234АМ',
        ];
    }

    private function carModels()
    {
        return [
            'T25',
            '9',
            '6',
            'x5'
        ];
    }
}
