<?php

namespace App\Http\Requests\Driver;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $driverProfileId = $this->route('driver')?->id;

        return [
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('driver_profiles', 'user_id')->ignore($driverProfileId),
            ],
            'license_number' => ['nullable', 'string', 'max:50'],
            'license_expiry' => ['nullable', 'date'],
            'is_available' => ['boolean'],
            'vehicle_ids' => ['nullable', 'array'],
            'vehicle_ids.*' => ['exists:vehicles,id'],
        ];
    }
}