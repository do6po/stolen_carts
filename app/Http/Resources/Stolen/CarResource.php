<?php

namespace App\Http\Resources\Stolen;

use App\Http\Resources\Cars\ModelResource;
use App\Models\StolenCars\Car;
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
            'vin' => $car->vin,
            'registration_plate' => $car->registration_plate,
            'color' => $car->color,
            'year' => $car->year,
            'model' => ModelResource::make($car->model),
        ];
    }
}
