<?php

namespace App\Console\Commands\CarBase;

use App\Services\CarLibs\CarBaseService;
use App\Services\CarLibs\RemoteCarBaseService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class CarMakesUpdate extends Command
{
    protected $signature = 'car-base:make:update';

    protected $description = 'Обновление производителей';

    protected int $rowLimit = 1000;

    protected RemoteCarBaseService $remoteCarBaseService;

    protected CarBaseService $carBaseService;

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->init();

        $this->info('Выгрузка производителей из удаленного сервера...');

        $makes = $this->remoteCarBaseService->makes();

        $this->info(sprintf('Получено %s производителей.', count($makes)));

        $prepared = $this->prepareToImport($makes);

        $this->info('Импорт производителей в локальную базу...');

        $count = $this->import($prepared);

        $this->info(sprintf('Было добавлено %s записей.', $count));
    }

    private function init()
    {
        $this->remoteCarBaseService = app(RemoteCarBaseService::class);
        $this->carBaseService = app(CarBaseService::class);
    }

    private function prepareToImport(array $makes)
    {
        $result = [];

        foreach ($makes as $make) {
            $result[] = [
                'name' => $make['Make_Name'],
                'remote_id' => $make['Make_ID'],
            ];
        }

        return $result;
    }

    private function import(array $prepared): int
    {
        $updated = 0;

        foreach (array_chunk($prepared, $this->rowLimit) as $importChunk) {
            $updated += $this->carBaseService->batchUpdate($importChunk);
        }

        return $updated;
    }
}
