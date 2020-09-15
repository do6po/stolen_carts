<?php

namespace Feature\Cars;

use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarSearchTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_find_make_by_name()
    {
        $this->createFakeMakes();

        $result = $this->jsonGet(route('api.cars.makes.search'), ['query' => 'TOY']);

        $result->assertResponseStatus(Response::HTTP_OK);
        $result->seeJsonContains(
            [
                'data' => [
                    [
                        'id' => 2,
                        'name' => 'TOYAMA'
                    ],
                    [
                        'id' => 1,
                        'name' => 'TOYOTA',
                    ],
                ]
            ]
        );
    }

    protected function createFakeMakes(): void
    {
        $makes = [
            1 => 'TOYOTA',
            2 => 'TOYAMA',
            3 => 'MAZDA',
            4 => 'NISSAN',
        ];

        foreach ($makes as $id => $name) {
            factory(CarMake::class)->create(
                [
                    'id' => $id,
                    'name' => $name,
                ]
            );
        }
    }

    public function test_it_get_exception_if_query_is_empty()
    {
        $this->createFakeMakes();

        $result = $this->jsonGet(route('api.cars.makes.search', ['query' => '']));

        $result->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_it_search_model()
    {
        $this->createFakeMakes();
        $this->createMakeModels();

        $route = route('api.cars.models.search', ['id' => 1]);
        $result = $this->jsonGet($route, ['query' => 'AVEN']);

        $result->assertResponseOk();

        $result->seeJsonContains(
            [
                'data' => [
                    [
                        'id' => 1,
                        'make' => [
                            'id' => 1,
                            'name' => 'TOYOTA',
                        ],
                        'name' => 'AVENSIS',
                    ]
                ]
            ]
        );
    }

    private function createMakeModels()
    {
        factory(CarModel::class)->create(
            [
                'id' => 1,
                'name' => 'AVENSIS',
                'make_id' => 1
            ]
        );
        factory(CarModel::class)->create(
            [
                'id' => 2,
                'name' => 'YARIS',
                'make_id' => 1
            ]
        );
    }
}
