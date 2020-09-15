<?php

namespace Unit\Models;

use App\Models\Car;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_create_car()
    {
        $attributes = [
            'name' => $this->faker()->name,
            'registration_plate' => $this->faker()->randomElement($this->carNumber()),
            'color' => $this->faker()->colorName,
            'make' => $this->faker()->randomElement($this->carMakes()),
            'model' => $this->faker()->randomElement($this->carModels()),
            'year' => $this->faker()->year,
        ];

        $this->notSeeInDatabase(Car::TABLE_NAME, $attributes);

        Car::query()->create($attributes);

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

    private function carMakes()
    {
        return [
            'toyota',
            'audi',
            'bmw',
            'vaz',
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
