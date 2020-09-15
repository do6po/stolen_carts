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

    public function test_it_update_car()
    {
        /** @var Car $car */
        $car = factory(Car::class)->create();

        $oldAttributes = [
            'id' => $car->id,
            'name' => $car->name,
        ];
        $this->seeInDatabase(
            Car::TABLE_NAME,
            $oldAttributes
        );

        $newAttributes = $oldAttributes;

        $newAttributes['name'] = 'new name';

        $result = $this->jsonPut(
            route('api.stolen.update', ['id' => $car->id]),
            array_merge($car->toArray(), $newAttributes)
        );

        $result->assertResponseOk();

        $this->notSeeInDatabase(
            Car::TABLE_NAME,
            $oldAttributes
        );

        $this->seeInDatabase(
            Car::TABLE_NAME,
            $newAttributes
        );
    }

    public function test_it_delete_car()
    {
        /** @var Car $car */
        $car = factory(Car::class)->create();

        $this->seeInDatabase(Car::TABLE_NAME, ['id' => $car->id]);

        $result = $this->jsonDelete(route('api.stolen.delete', ['id' => $car->id]));

        $result->assertResponseStatus(Response::HTTP_NO_CONTENT);

        $this->notSeeInDatabase(Car::TABLE_NAME, ['id' => $car->id]);
    }
}
