<?php

namespace App\Http\Resources\Cars;

use App\Models\Cars\CarModel;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var CarModel $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'name' => $model->name,
            'make' => MakeResource::make($model->make),
        ];
    }
}
