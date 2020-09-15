<?php

namespace App\Services;

use App\Models\StolenCars\Car;

class CarService
{

    public function create(array $validated): Car
    {
        $car = Car::query()->make($validated);
        $car->model_id = $validated['model_id'];

        $car->save();

        return $car;
    }

}
