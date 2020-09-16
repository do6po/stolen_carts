<?php

namespace App\Http\Controllers\Api\Stolen;

use App\Http\Requests\StolenCarRequest;
use App\Http\Resources\Stolen\CarResource;
use App\Models\StolenCars\Car;
use App\Services\StolenCarService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Throwable;

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

    public function index(Request $request): AnonymousResourceCollection
    {
        $cars = Car::query()
            ->filter($request->all())
            ->paginate();

        return CarResource::collection($cars);
    }

    /**
     * @param StolenCarRequest $request
     * @return CarResource
     * @throws GuzzleException
     * @throws Throwable
     */
    public function store(StolenCarRequest $request): CarResource
    {
        $car = $this->stoleCarService->create($request->validated());

        return CarResource::make($car);
    }

    /**
     * @param int $id
     * @param StolenCarRequest $request
     * @return CarResource
     * @throws GuzzleException
     * @throws Throwable
     */
    public function update(int $id, StolenCarRequest $request): CarResource
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
