<?php

// database/seeders/VehicleTypeSeeder.php
namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VehicleTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Sedan', 'SUV', 'Van', 'Mini Bus', 'Coach'];

        foreach ($types as $name) {
            VehicleType::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}