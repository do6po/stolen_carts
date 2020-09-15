<?php


namespace App\Http\Controllers\Api\Stolen;


use App\Http\Requests\CarRequest;
use App\Http\Resources\Stolen\CarResource;
use App\Services\CarService;

class StolenCarController
{

    /**
     * @var CarService
     */
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function store(CarRequest $request)
    {
        $car = $this->carService->create($request->validated());

        return CarResource::make($car);
    }
}
