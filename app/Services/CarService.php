<?php

namespace App\Services;

use App\Models\Car;

class CarService
{
    public function create(array $validated): Car
    {
        /** @var Car $car */
        $car = Car::query()->make($validated);
        $car->make_id = $validated['make_id'];

        $car->save();

        return $car;
    }
}
