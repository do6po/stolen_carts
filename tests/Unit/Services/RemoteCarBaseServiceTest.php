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
        $data = $this->service->makes();

        $make = array_shift($data);

        $this->assertEquals('ASTON MARTIN', $make['Make_Name']);
        $this->assertEquals(440, $make['Make_ID']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(RemoteCarBaseService::class);
    }
}
