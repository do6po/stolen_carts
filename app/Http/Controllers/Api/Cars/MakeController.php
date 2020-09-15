<?php

namespace App\Http\Controllers\Api\Cars;

use App\Http\Requests\MakeSearchRequest;
use App\Http\Resources\Cars\MakeResource;
use App\Models\Cars\CarMake;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Laravel\Lumen\Http\Request;

class MakeController
{
    const PER_PAGE = 100;

    public function search(MakeSearchRequest $request): AnonymousResourceCollection
    {
        $query = $request->input('query');

        $makes = CarMake::query()
            ->where('name', 'LIKE', "%$query%")
            ->orderBy('name')
            ->paginate(self::PER_PAGE);

        return MakeResource::collection($makes);
    }
}
