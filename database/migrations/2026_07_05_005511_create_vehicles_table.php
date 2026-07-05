<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_type_id')->constrained()->restrictOnDelete();
            $table->string('registration_number')->unique();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedSmallInteger('capacity');
            $table->string('status')->default('active'); // backed by VehicleStatus enum
            $table->timestamps();

            $table->index(['status', 'vehicle_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};