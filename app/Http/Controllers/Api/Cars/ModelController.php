<?php

namespace App\Http\Controllers\Api\Cars;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\Cars\ModelResource;
use App\Models\Cars\CarMake;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModelController
{
    const PER_PAGE = 100;

    public function search(int $id, SearchRequest $make): AnonymousResourceCollection
    {
        $carMake = CarMake::query()->findOrFail($id);

        $query = $make->input('query');

        $models = $carMake->models()
            ->whereRaw('LOWER(name) LIKE ?', ["%$query%"])
            ->with(['manufacturer'])
            ->paginate(self::PER_PAGE)
            ->appends(['query' => $query]);

        return ModelResource::collection($models);
    }

}
