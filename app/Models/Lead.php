<?php

// app/Models/Lead.php
namespace App\Models;

use App\Enums\LeadStatus;
use App\Enums\LeadType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'status', 'name', 'email', 'phone', 'message', 'source', 'meta'])]
class Lead extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => LeadType::class,
            'status' => LeadStatus::class,
            'meta' => 'array',
        ];
    }
}