<?php

namespace TemperatureSensor\Api\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorReadingResource extends JsonResource
{
    public static $wrap = 'temperatureSensorReadingInfo';

    public function toArray(Request $request): array
    {
        return [self::$wrap => $this->resource];
    }
}
