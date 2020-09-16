<?php

namespace App\Services\CarLibs;

use App\Models\CarBase\ResolvedCar;
use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;

class CarBaseService
{

    public function createModelOrGet(ResolvedCar $resolvedCar): CarModel
    {
        $model = CarModel::query()
            ->where('remote_id', $resolvedCar->getModelId())
            ->first();

        if (is_null($model)) {
            return $this->createModel($resolvedCar);
        }

        return $model;
    }

    public function createModel(ResolvedCar $resolvedCar): CarModel
    {
        $make = $this->createMakeOrGet($resolvedCar);

        return CarModel::query()
            ->create(
                [
                    'name' => $resolvedCar->getModelName(),
                    'make_id' => $make->id,
                    'remote_id' => $resolvedCar->getModelId(),
                ]
            );
    }

    public function createMakeOrGet(ResolvedCar $resolvedCar): CarMake
    {
        $make = CarMake::query()
            ->where('remote_id', $resolvedCar->getMakeId())
            ->first();

        if (is_null($make)) {
            return $this->createMake($resolvedCar);
        }

        return $make;
    }

    public function createMake(ResolvedCar $resolvedCar): CarMake
    {
        return CarMake::query()
            ->create(
                [
                    'name' => $resolvedCar->getMakeName(),
                    'remote_id' => $resolvedCar->getMakeId()
                ]
            );
    }

    public function batchUpdate(array $prepared): int
    {
        return CarMake::query()->insertOrIgnore($prepared);
    }
}
