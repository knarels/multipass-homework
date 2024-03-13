<?php

namespace TemperatureSensor\Api\Controllers;

use Carbon\Carbon;
use TemperatureSensor\Api\Requests\SensorReadingCreateRequest;
use TemperatureSensor\Api\Requests\SensorReadingDateRangeRequest;
use TemperatureSensor\Api\Requests\SensorReadingHourRequest;
use TemperatureSensor\Api\Requests\SensorReadingUpdateRequest;
use TemperatureSensor\Api\Resources\SensorReadingResource;
use TemperatureSensor\Helpers\ConvertTemperatureHelper;
use TemperatureSensor\Models\TemperatureSensorReading;
use TemperatureSensor\Repositories\SensorReadingRepository;

class SensorReadingController
{
    private SensorReadingRepository $sensorReadingRepository;

    public function __construct(SensorReadingRepository $sensorReadingRepository)
    {
        $this->sensorReadingRepository = $sensorReadingRepository;
    }

    public function get(TemperatureSensorReading $temperatureSensorReading): SensorReadingResource
    {
        return new SensorReadingResource($temperatureSensorReading);
    }

    public function create(SensorReadingCreateRequest $request): SensorReadingResource
    {
        $validatedData = $request->validated()[$request->wrapper];
        $validatedData['temperature_celsius'] = ConvertTemperatureHelper::convertFahrenheitToCelsius(
            $validatedData['temperature_fahrenheit']
        );

        $reading = $this->sensorReadingRepository->create($validatedData);

        return new SensorReadingResource($reading);
    }

    public function update(SensorReadingUpdateRequest $request): SensorReadingResource
    {
        $validatedData = $request->validated()[$request->wrapper];
        $temperatureSensorReading = $this->sensorReadingRepository->getByIdOrFail($validatedData['id']);

        $reading = $this->sensorReadingRepository->update($temperatureSensorReading, $validatedData);

        return new SensorReadingResource($reading);
    }

    public function delete(TemperatureSensorReading $temperatureSensorReading): SensorReadingResource
    {
        $temperatureSensorReading = $this->sensorReadingRepository->delete($temperatureSensorReading);

        return new SensorReadingResource($temperatureSensorReading);
    }

    public function getAverageTemperaturesInDateRange(
        SensorReadingDateRangeRequest $request
    ): SensorReadingResource {
        $validatedData = $request->validated()[$request->wrapper];
        $startDate = Carbon::make($validatedData['start_date']) ?? Carbon::now();
        $endDate = Carbon::make($validatedData['end_date']) ?? Carbon::now();

        $averageTemperatures = $this->sensorReadingRepository
            ->getAverageTemperaturesInDateRange($startDate->startOfDay(), $endDate->endOfDay());

        return new SensorReadingResource($averageTemperatures);
    }

    public function getAverageTemperaturesOnHour(
        SensorReadingHourRequest $request
    ): SensorReadingResource {
        $validatedData = $request->validated()[$request->wrapper];
        $startDate = Carbon::make($validatedData['date_hour']) ?? Carbon::now();
        $endDate = Carbon::make($validatedData['date_hour']) ?? Carbon::now();

        $averageTemperatures = $this->sensorReadingRepository
            ->getAverageTemperaturesInDateRange($startDate->startOfHour(), $endDate->endOfHour());

        return new SensorReadingResource($averageTemperatures);
    }
}
