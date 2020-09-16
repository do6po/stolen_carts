<?php

namespace App\Console\Commands\CarBase;

use App\Models\Cars\CarMake;
use App\Services\CarLibs\CarBaseService;
use App\Services\CarLibs\RemoteCarBaseService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class CarModelsSync extends Command
{
    protected $signature = 'car-base:model:sync';

    protected $description = 'Обновление моделей';

    protected int $rowLimit = 1000;

    protected RemoteCarBaseService $remoteCarBaseService;

    protected CarBaseService $carBaseService;

    protected ProgressBar $progressBar;

    protected array $remoteMakeIdToLocalId;

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->init();

        $this->info('Выгрузка моделей из удаленного сервера...');

        $makes = CarMake::query()->get();

        $this->prepareResolver($makes);

        $this->info(sprintf('Импорт моделей будет выполнен для %s производителей.', $makes->count()));

        $count = $this->import($makes);

        $this->info(PHP_EOL);
        $this->info(sprintf('Было добавлено %s записей.', $count));
    }

    private function init()
    {
        $this->remoteCarBaseService = app(RemoteCarBaseService::class);
        $this->carBaseService = app(CarBaseService::class);
    }

    /**
     * @param Collection|CarMake[] $makes
     */
    private function prepareResolver(Collection $makes)
    {
        foreach ($makes as $make) {
            $this->remoteMakeIdToLocalId[$make->remote_id] = $make->id;
        }
    }

    /**
     * @param Collection|CarMake[] $makes
     * @return int
     * @throws GuzzleException
     */
    private function import(Collection $makes): int
    {
        $imported = 0;

        $this->initProgressBar($makes);

        foreach ($makes as $make) {
            $remoteModels = $this->remoteCarBaseService->getModelsByMakeId($make->remote_id);

            $prepared = $this->prepareToImport($remoteModels);

            $imported += $this->carBaseService->modelsBatchSync($prepared);

            $this->progressBar->advance();
        }

        $this->progressBar->finish();

        return $imported;
    }

    private function initProgressBar(Collection $prepared): void
    {
        $this->progressBar = $this->output->createProgressBar($prepared->count());

        $this->progressBar->setFormat('debug');

        $this->progressBar->start();
    }

    private function prepareToImport(array $remoteModels): array
    {
        $result = [];

        foreach ($remoteModels as $model) {
            if ($localMakeId = $this->resolveMakeId($model)) {
                $result[] = [
                    'make_id' => $localMakeId,
                    'remote_id' => $model['Model_ID'],
                    'name' => $model['Model_Name'],
                ];
            }
        }

        return $result;
    }

    private function resolveMakeId($model): ?int
    {
        $makeId = $model['Make_ID'];

        return $this->remoteMakeIdToLocalId[$makeId] ?? null;
    }
}
