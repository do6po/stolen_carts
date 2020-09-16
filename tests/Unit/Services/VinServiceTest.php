<?php

namespace Unit\Services;

use App\Services\CarLibs\VinService;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TestCase;

class VinServiceTest extends TestCase
{

    private VinService $service;

    /**
     * @throws GuzzleException
     */
    public function test_it_get_car_by_vin()
    {
        $car = [
            'vin' => '3FA6P0VP1HR282209',
            'model_name' => 'Fusion',
            'model_id' => 1780,
            'make_name' => 'FORD',
            'make_id' => 460,
            'year' => 2017,
        ];
        $model = $this->service->findCarByVin($car['vin']);

        $this->assertEquals($car['year'], $model->getYear());
        $this->assertEquals($car['vin'], $model->getVin());
        $this->assertEquals($car['model_name'], $model->getModelName());
        $this->assertEquals($car['model_id'], $model->getModelId());
        $this->assertEquals($car['make_name'], $model->getMakeName());
        $this->assertEquals($car['make_id'], $model->getMakeId());
    }

    /**
     * @throws GuzzleException
     */
    public function test_it_not_found_car_by_not_exist_vin()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->service->findCarByVin('4FA6P0VP1HR288801');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(VinService::class);
    }
}
