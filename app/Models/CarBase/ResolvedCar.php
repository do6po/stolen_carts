<?php

namespace App\Models\CarBase;

class ResolvedCar
{
    protected array $vehicleInfo;

    public function __construct(array $vehicleInfo)
    {
        $this->vehicleInfo = $vehicleInfo;
    }

    public function getModelId(): ?int
    {
        return $this->vehicleInfo['ModelID'] ?? null;
    }

    public function getMakeId(): ?int
    {
        return $this->vehicleInfo['MakeID'] ?? null;
    }

    public function getModelName(): ?string
    {
        return $this->vehicleInfo['Model'] ?? null;
    }

    public function getMakeName(): ?string
    {
        return $this->vehicleInfo['Make'] ?? null;
    }

    public function getYear(): ?int
    {
        return $this->vehicleInfo['ModelYear'] ?? null;
    }

    public function getVin(): ?string
    {
        return $this->vehicleInfo['VIN'] ?? null;
    }

    public function getColor(): ?string
    {
        //TODO color not found in result array
        return null;
    }
}
