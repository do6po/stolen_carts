<?php

namespace App\Services\CarLibs;

use App\Core\Services\ApiService;
use App\Models\CarBase\ResolvedCar;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VinService
{
    /**
     * @var ApiService
     */
    protected ApiService $api;

    protected string $url = 'https://vpic.nhtsa.dot.gov/api';

    protected array $headers = [
        'Content-Type' => 'application/json',
    ];

    protected array $baseOptions = [
        'format' => 'json',
    ];

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * @param string $vin
     * @return ResolvedCar
     * @throws GuzzleException
     */
    public function findCarByVin(string $vin): ResolvedCar
    {
        $options = $this->getOptions();

        $response = $this->api->get(
            sprintf(
                '%s/%s/%s?%s',
                $this->url,
                'vehicles/DecodeVinValues',
                $vin,
                http_build_query($this->baseOptions)
            ),
            $options
        );

        $vehicleInfo = array_shift($response['Results']);

        if ($vehicleInfo['ErrorCode'] != 0) {
            throw new NotFoundHttpException("Car with vin {$vin} not found!");
        }

        return new ResolvedCar($vehicleInfo);
    }

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            'json' => $this->baseOptions,
            'headers' => $this->headers,
        ];
    }
}
