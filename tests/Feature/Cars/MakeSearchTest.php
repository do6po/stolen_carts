<?php

namespace Feature\Cars;

use App\Models\Cars\CarMake;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class MakeSearchTest extends TestCase
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
}
