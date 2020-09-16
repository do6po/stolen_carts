<?php

namespace App\Filters\StolenCars;

use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;
use App\Models\StolenCars\Car;
use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * @mixin Car
 */
class StolenCarsFilter extends ModelFilter
{
    public function setup()
    {
        $tableName = Car::TABLE_NAME;

        $this->select([$tableName . '.*'])
            ->joinMakes();
    }

    public function modelName(string $name)
    {
        $this->whereRaw('LOWER(car_models.name) LIKE ?', ["%$name%"]);
    }

    public function makeName(string $name)
    {
        $this->whereRaw('LOWER(car_makes.name) LIKE ?', ["%$name%"]);
    }

    public function model(int $id)
    {
        $this->where('model_id', $id);
    }

    public function manufacturer(int $id)
    {
        $this->whereHas(
            'model',
            function (Builder $builder) use ($id) {
                $builder->where('make_id', $id);
            }
        );
    }

    public function vin(string $number)
    {
        $number = Str::lower($number);
        $this->whereRaw('LOWER(cars.vin) LIKE ?', ["%$number%"]);
    }

    public function name(string $name)
    {
        $name = Str::lower($name);
        $this->whereRaw('LOWER(cars.name) LIKE ?', ["%$name%"]);
    }

    public function registrationPlate(string $number)
    {
        $this->whereRaw('LOWER(cars.registration_plate) LIKE ?', ["%$number%"]);
    }

    public function color($name)
    {
        $this->where(Car::TABLE_NAME . '.color', $name);
    }

    public function year(int $year)
    {
        $this->where(Car::TABLE_NAME . '.year', $year);
    }

    public function order(string $columnAndDirection)
    {
        [$column, $direction] = explode('-', $columnAndDirection);

        $tableName = Car::TABLE_NAME;

        switch ($column) {
            case 'name' :
                return $this->orderBy($tableName . '.name', $direction);
            case 'vin':
                return $this->orderBy($tableName . '.vin', $direction);
            case 'registration_plate':
                return $this->orderBy($tableName . '.registration_plate', $direction);
            case 'color':
                return $this->orderBy($tableName . '.color', $direction);
            case 'year':
                return $this->orderBy($tableName . '.year', $direction);
            case 'model_name':
                return $this->orderBy(CarModel::TABLE_NAME . '.name', $direction);
            case 'make_name':
                return $this->orderBy(CarMake::TABLE_NAME . '.name', $direction);
            default:
                return $this->orderBy($tableName . '.name', 'asc');
        }
    }
}
