<?php

// app/Http/Requests/Vehicle/VehicleRequest.php
namespace App\Http\Requests\Vehicle;

use App\Enums\VehicleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // gate/policy already enforced at the route level
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $vehicleId = $this->route('vehicle')?->id;

        return [
            'vehicle_type_id' => ['required', 'exists:vehicle_types,id'],
            'registration_number' => [
                'required', 'string', 'max:20',
                Rule::unique('vehicles', 'registration_number')->ignore($vehicleId),
            ],
            'make' => ['nullable', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'min:1980', 'max:'.(date('Y') + 1)],
            'capacity' => ['required', 'integer', 'min:1', 'max:100'],
            'status' => ['required', Rule::enum(VehicleStatus::class)],
        ];
    }
}