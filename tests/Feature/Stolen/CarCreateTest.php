<?php

namespace Feature\Stolen;

use App\Models\StolenCars\Car;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarCreateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_create_new_stolen_car()
    {
        $attributes = [
            'name' => 'Новая украденная машина',
            'color' => 'red',
            'vin' => '3FA6P0VP1HR282209',
            'registration_plate' => 'ВТ3003ВЕ',
            'year' => 1939,
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

    public function test_it_try_to_set_not_exists_vin()
    {
        $attributes = [
            'name' => 'Не существующая машина',
            'color' => 'red',
            'vin' => '4FA6P0VP1HR282209',
            'registration_plate' => 'ВТ3003ВЕ',
            'year' => 1939,
        ];

        $result = $this->jsonPost(route('api.stolen.create'), $attributes);

        $result->assertResponseStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
//        $result->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
