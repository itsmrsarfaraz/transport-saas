<?php

namespace Database\Factories;

use App\Enums\VehicleStatus;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'vehicle_type_id' => VehicleType::factory(),
            'registration_number' => strtoupper(fake()->unique()->bothify('???-####')),
            'make' => fake()->randomElement(['Toyota', 'Hyundai', 'Nissan', 'Mercedes-Benz']),
            'model' => fake()->word(),
            'year' => fake()->numberBetween(2015, 2026),
            'capacity' => fake()->numberBetween(4, 45),
            'status' => fake()->randomElement(VehicleStatus::cases())->value,
        ];
    }
}