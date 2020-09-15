<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Make;

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

    public function createMake(array $attributes): Make
    {
        /** @var Make $make */
        $make = Make::query()->create($attributes);

        return $make;
    }
}
