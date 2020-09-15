<?php

namespace Feature\Stolen;

use App\Models\Cars\CarModel;
use App\Models\StolenCars\Car;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarCreateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_create_new_stolen_car()
    {
        /** @var CarModel $model */
        $model = factory(CarModel::class)->create();

        $attributes = [
            'name' => 'Новая украденная машина',
            'color' => 'red',
            'vin' => 'ВТ3003ВЕВТ3003ВЕ',
            'registration_plate' => 'ВТ3003ВЕ',
            'year' => 2001,
            'model_id' => $model->id,
        ];

        $this->notSeeInDatabase(Car::TABLE_NAME, $attributes);

        $result = $this->jsonPost(route('api.stolen.create'), $attributes);

        $result->assertResponseStatus(Response::HTTP_CREATED);

        $this->seeInDatabase(Car::TABLE_NAME, $attributes);

    }
}
