<?php

namespace App\Http\Resources\Cars;

use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'make' => MakeResource::make($this->make),
        ];
    }
}
