<?php

namespace Feature\Cars;

use App\Models\Car;
use App\Models\Make;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CreateCarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_create_car_from_api()
    {
        /** @var Make $make */
        $make = factory(Make::class)->create(['name' => 'ford']);

        $attributes = [
            'name' => 'Машина Дениса',
            'registration_plate' => 'ВТ3003ВЕ',
            'color' => 'gray',
            'model' => 'Fusion',
            'year' => 2018,
            'make_id' => $make->id,
        ];

        $this->notSeeInDatabase(Car::TABLE_NAME, $attributes);

        $response = $this->jsonPost(route('api.cars.create'), $attributes);

        $response->assertResponseStatus(Response::HTTP_CREATED);

        $this->seeInDatabase(Car::TABLE_NAME, $attributes);
    }
}
