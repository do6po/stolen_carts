<?php

namespace App\Services;

use App\Models\StolenCars\Car;

class CarService
{

    public function findOrFail(int $id): Car
    {
        return Car::query()->findOrFail($id);
    }

    public function create(array $validated): Car
    {
        $car = Car::query()->make($validated);
        $car->model_id = $validated['model_id'];

        $car->save();

        return $car;
    }

    public function update(Car $car, array $validated): Car
    {
        $car->fill($validated);
        $car->model_id = $validated['model_id'];

        $car->save();

        return $car;
    }

}
