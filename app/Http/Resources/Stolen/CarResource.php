<?php

namespace App\Http\Resources\Cars;

use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{

    public function toArray($request): array
    {
        /** @var Car $car */
        $car = $this->resource;

        return [
            'id' => $car->id,
            'name' => $car->name,
            'registration_plate' => $car->registration_plate,
            'color' => $car->color,
            'year' => $car->year,
            'model_id' => $car->model,
        ];
    }
}
