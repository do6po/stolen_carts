<?php

namespace Unit\Models\StoleCars;

use App\Models\Cars\CarModel;
use App\Models\StolenCars\Car;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_register_stolen_car()
    {
        /** @var CarModel $model */
        $model = factory(CarModel::class)->create();
        $attributes = [
            'name' => 'Васина тачка',
            'color' => 'red',
            'vin' => 'ВТ3003ВЕВТ3003ВЕ',
            'registration_plate' => 'ВТ3003ВЕ',
            'year' => 2001,
        ];

        $this->notSeeInDatabase(Car::TABLE_NAME, $attributes);

        $car = Car::query()->make($attributes);
        $car->model_id = $model->id;
        $car->save();

        $this->seeInDatabase(Car::TABLE_NAME, $attributes);
    }
}
