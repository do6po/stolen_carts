<?php

namespace Unit\Services;

use App\Models\CarBase\ResolvedCar;
use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;
use App\Services\CarLibs\CarBaseService;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CarBaseServiceTest extends TestCase
{
    use DatabaseTransactions;

    private CarBaseService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(CarBaseService::class);
    }

    public function test_it_create_new_make_and_model()
    {
        $vehicleInfoArray = [
            'Model' => 'Fusion',
            'ModelID' => 100,
            'Make' => 'FORD',
            'MakeID' => 10,
        ];
        $resolvedCar = new ResolvedCar($vehicleInfoArray);

        $this->notSeeInDatabase(
            CarMake::TABLE_NAME,
            [
                'remote_id' => $resolvedCar->getMakeId(),
                'name' => $resolvedCar->getMakeName(),
            ]
        );

        $this->notSeeInDatabase(
            CarModel::TABLE_NAME,
            [
                'remote_id' => $resolvedCar->getModelId(),
                'name' => $resolvedCar->getModelName(),
            ]
        );

        $this->service->createModelOrGet($resolvedCar);

        $this->seeInDatabase(
            CarMake::TABLE_NAME,
            [
                'remote_id' => $resolvedCar->getMakeId(),
                'name' => $resolvedCar->getMakeName(),
            ]
        );
        $this->seeInDatabase(
            CarModel::TABLE_NAME,
            [
                'remote_id' => $resolvedCar->getModelId(),
                'name' => $resolvedCar->getModelName(),
            ]
        );

    }
}
