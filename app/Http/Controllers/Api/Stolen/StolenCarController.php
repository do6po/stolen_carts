<?php

namespace App\Http\Controllers\Api\Stolen;

use App\Http\Requests\CarRequest;
use App\Http\Resources\Stolen\CarResource;
use App\Services\CarService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StolenCarController
{

    /**
     * @var CarService
     */
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function store(CarRequest $request): CarResource
    {
        $car = $this->carService->create($request->validated());

        return CarResource::make($car);
    }

    public function update(int $id, CarRequest $request): CarResource
    {
        $car = $this->carService->update(
            $this->carService->findOrFail($id),
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
        $this->carService->findOrFail($id)->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
