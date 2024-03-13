<?php

use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Route;
use TemperatureSensor\Api\Controllers\SensorController;
use TemperatureSensor\Api\Controllers\SensorReadingController;

Route::group([
    'as' => 'temperature_sensor',
    'prefix' => 'api/temperature_sensor',
    'middleware' => [SubstituteBindings::class],
], static function () {
    Route::get('/{temperatureSensor}', [SensorController::class, 'get']);
    Route::post('/', [SensorController::class, 'create']);
    Route::delete('/{temperatureSensor}', [SensorController::class, 'delete']);

    Route::get('/{temperatureSensor}/data', [SensorController::class, 'getReadingData']);

    Route::group([
        'prefix' => '/reading',
    ], static function () {
        Route::get('/{temperatureSensorReading}', [SensorReadingController::class, 'get']);
        Route::post('/', [SensorReadingController::class, 'create']);
        Route::put('/', [SensorReadingController::class, 'update']);
        Route::delete('/{temperatureSensorReading}', [SensorReadingController::class, 'delete']);

        Route::group([
            'prefix' => '/average'
        ], static function () {
            Route::post('/range', [SensorReadingController::class, 'getAverageTemperaturesInDateRange']);
            Route::post('/hour', [SensorReadingController::class, 'getAverageTemperaturesOnHour']);
        });
    });
});
