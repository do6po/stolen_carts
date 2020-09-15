<?php

namespace App\Http\Controllers\Api\Cars;

use App\Http\Requests\CarRequest;
use App\Http\Resources\Cars\CarResource;
use App\Services\CarService;

class CarController
{
    public function create(CarRequest $request, CarService $carService): CarResource
    {
        $car = $carService->create($request->validated());

        return CarResource::make($car);
    }
}
