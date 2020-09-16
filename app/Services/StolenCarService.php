<?php

namespace App\Services;

use App\Models\StolenCars\Car;
use App\Services\CarLibs\CarBaseService;
use App\Services\CarLibs\VinService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class StolenCarService
{

    protected VinService $vinService;

    protected CarBaseService $carBaseService;

    public function __construct(
        VinService $vinService,
        CarBaseService $carBaseService
    ) {
        $this->vinService = $vinService;
        $this->carBaseService = $carBaseService;
    }

    public function findOrFail(int $id): Car
    {
        return Car::query()->findOrFail($id);
    }

    /**
     * @param array $validated
     * @return Car
     * @throws Throwable
     * @throws GuzzleException
     */
    public function create(array $validated): Car
    {
        try {
            $carInfo = $this->vinService->findCarByVin($validated['vin']);

            $model = $this->carBaseService->createModelOrGet($carInfo);

            $car = Car::query()->make($validated);
            $car->model_id = $model->id;

            $car->save();

            return $car;
        } catch (NotFoundHttpException $exception) {
            Log::error($exception);

            throw ValidationException::withMessages(
                [
                    'vin' => [
                        $exception->getMessage()
                    ]
                ]
            );
        } catch (Throwable $exception) {
            Log::error($exception);

            throw $exception;
        }
    }

    public function update(Car $car, array $validated): Car
    {
        $car->fill($validated);
        $car->model_id = $validated['model_id'];

        $car->save();

        return $car;
    }

}
