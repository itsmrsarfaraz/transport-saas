<?php

// app/Http/Requests/Lead/StoreLeadRequest.php
namespace App\Http\Requests\Lead;

use App\Enums\LeadType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // public-facing form, no auth required
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::enum(LeadType::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['nullable', 'string', 'max:2000'],
            'source' => ['nullable', 'string', 'max:50'],

            // meta fields — only validated when relevant to the submitted type
            'pickup_location' => ['required_if:type,route_inquiry', 'string', 'max:255'],
            'dropoff_location' => ['required_if:type,route_inquiry', 'string', 'max:255'],
            'travel_date' => ['required_if:type,route_inquiry', 'date', 'after_or_equal:today'],
            'budget' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    /**
     * Pull out only the fields that belong in the `meta` JSON column.
     */
    public function metaFields(): array
    {
        return $this->only(['pickup_location', 'dropoff_location', 'travel_date', 'budget']);
    }
}