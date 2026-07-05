<?php
// database/migrations/2026_07_06_000003_create_driver_document_types_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driver_document_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // e.g. drivers-license, national-id, medical-certificate
            $table->string('description')->nullable();
            $table->boolean('is_required')->default(false); // admin flags mandatory doc types
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_document_types');
    }
};