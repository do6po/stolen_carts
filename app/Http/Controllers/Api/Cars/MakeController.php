<?php

namespace App\Http\Controllers\Api\Cars;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\Cars\MakeResource;
use App\Models\Cars\CarMake;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MakeController
{
    const PER_PAGE = 100;

    public function search(SearchRequest $request): AnonymousResourceCollection
    {
        $query = $request->input('query');

        $makes = CarMake::query()
            ->whereRaw('BINARY name LIKE ?', ["%$query%"])
            ->orderBy('name')
            ->paginate(self::PER_PAGE)
            ->appends(['query' => $query]);

        return MakeResource::collection($makes);
    }
}
