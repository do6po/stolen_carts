<?php

namespace App\Http\Resources\Cars;

use App\Models\Cars\CarMake;
use Illuminate\Http\Resources\Json\JsonResource;

class MakeResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var CarMake $make */
        $make = $this->resource;

        return [
            'id' => $make->id,
            'name' => $make->name,
        ];
    }
}
