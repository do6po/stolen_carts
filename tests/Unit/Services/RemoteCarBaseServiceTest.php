<?php

namespace Unit\Services;

use App\Services\CarLibs\RemoteCarBaseService;
use GuzzleHttp\Exception\GuzzleException;
use TestCase;

class RemoteCarBaseServiceTest extends TestCase
{

    private RemoteCarBaseService $service;

    /**
     * @throws GuzzleException
     */
    public function test_it_get_makes()
    {
        $data = $this->service->getMakes();

        $make = array_shift($data);

        $this->assertEquals('ASTON MARTIN', $make['Make_Name']);
        $this->assertEquals(440, $make['Make_ID']);
    }

    /**
     * @throws GuzzleException
     */
    public function test_it_get_models_by_make_id()
    {
        $makeId = 440;
        $remoteModels = $this->service->getModelsByMakeId($makeId);

        $model = array_shift($remoteModels);

        $this->assertEquals('V8 Vantage', $model['Model_Name']);
        $this->assertEquals(1684, $model['Model_ID']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(RemoteCarBaseService::class);
    }
}
