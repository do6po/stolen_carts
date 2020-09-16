<?php

namespace App\Http\Controllers\Api\Stolen;

use App\Http\Requests\CarRequest;
use App\Http\Resources\Stolen\CarResource;
use App\Services\StolenCarService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StolenCarController
{

    /**
     * @var StolenCarService
     */
    protected StolenCarService $stoleCarService;

    public function __construct(StolenCarService $carService)
    {
        $this->stoleCarService = $carService;
    }

    public function store(CarRequest $request): CarResource
    {
        $car = $this->stoleCarService->create($request->validated());

        return CarResource::make($car);
    }

    public function update(int $id, CarRequest $request): CarResource
    {
        $car = $this->stoleCarService->update(
            $this->stoleCarService->findOrFail($id),
            $request->validated()
        );

        return CarResource::make($car);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(int $id): JsonResponse
    {
        $this->stoleCarService->findOrFail($id)->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
