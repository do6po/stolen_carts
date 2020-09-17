<?php

namespace App\Http\Controllers\Api\Stolen;

use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;
use App\Models\StolenCars\Car;
use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

class StolenCarExportController
{
    /**
     * @return string
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws UnsupportedTypeException
     * @throws WriterNotOpenedException
     */
    public function export()
    {
        $carTable = Car::TABLE_NAME;
        $makeTable = CarMake::TABLE_NAME;
        $modelTable = CarModel::TABLE_NAME;
        $cars = Car::query()
            ->select(
                [
                    $carTable . '.id',
                    $carTable . '.name',
                    $carTable . '.vin',
                    $carTable . '.registration_plate',
                    $carTable . '.color',
                    $carTable . '.year',
                    $makeTable . '.id',
                    $makeTable . '.name as make_name',
                    $modelTable . '.id',
                    $modelTable . '.name as model_name',
                ]
            )
            ->joinMakes()
            ->get();

        return (new FastExcel($cars))->download('stolen_cars.xls');
    }
}
