<?php

namespace TemperatureSensor\Api\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorResource extends JsonResource
{
    public static $wrap = 'temperatureSensorInfo';

    public function toArray(Request $request): array
    {
        return [self::$wrap => $this->resource];
    }
}
