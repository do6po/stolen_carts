<?php

namespace App\Http\Resources\Cars;

use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{

    public function toArray($request): array
    {
        /** @var Car $car */
        $car = $this->resource;

        return [
            'id' => $car->id,
            'name' => $car->name,
            'model_id' => $car->model,
        ];
    }
}
