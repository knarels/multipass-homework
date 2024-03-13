<?php

namespace TemperatureSensor\Api\Controllers;

use App\Http\Controllers\Controller;
use TemperatureSensor\Api\Resources\SensorReadingDataCsvResource;
use TemperatureSensor\Api\Resources\SensorResource;
use TemperatureSensor\Models\TemperatureSensor;
use TemperatureSensor\Repositories\SensorRepository;
use TemperatureSensor\Services\SensorReadingCsvService;

class SensorController extends Controller
{
    private SensorRepository $sensorRepository;
    private SensorReadingCsvService $sensorReadingCsvService;

    public function __construct(
        SensorRepository $sensorRepository,
        SensorReadingCsvService $sensorReadingCsvService
    ) {
        $this->sensorRepository = $sensorRepository;
        $this->sensorReadingCsvService = $sensorReadingCsvService;
    }

    public function get(TemperatureSensor $temperatureSensor): SensorResource
    {
        return new SensorResource($temperatureSensor);
    }

    public function create(): SensorResource
    {
        $temperatureSensor = $this->sensorRepository->create();

        return new SensorResource($temperatureSensor);
    }

    public function delete(TemperatureSensor $temperatureSensor): SensorResource
    {
        $temperatureSensor = $this->sensorRepository->delete($temperatureSensor);

        return new SensorResource($temperatureSensor);
    }

    public function getReadingData(TemperatureSensor $temperatureSensor): SensorReadingDataCsvResource
    {
        $csvData = $this->sensorReadingCsvService->getSensorReadingCsvString($temperatureSensor);

        return new SensorReadingDataCsvResource($csvData);
    }
}
