<?php

// database/seeders/DriverDocumentTypeSeeder.php
namespace Database\Seeders;

use App\Models\DriverDocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DriverDocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => "Driver's License", 'is_required' => true],
            ['name' => 'National ID', 'is_required' => true],
            ['name' => 'Medical Certificate', 'is_required' => false],
        ];

        foreach ($types as $type) {
            DriverDocumentType::firstOrCreate(
                ['slug' => Str::slug($type['name'])],
                ['name' => $type['name'], 'is_required' => $type['is_required']]
            );
        }
    }
}