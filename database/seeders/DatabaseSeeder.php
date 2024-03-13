<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TemperatureSensor\Seeders\TemperatureSensorSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TemperatureSensorSeeder::class);
    }
}
