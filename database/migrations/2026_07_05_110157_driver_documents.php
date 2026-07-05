<?php
// database/migrations/2026_07_06_000006_create_driver_documents_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driver_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_document_type_id')->constrained()->restrictOnDelete();
            $table->string('file_path')->nullable(); // storage disk path, wired up when file upload is added
            $table->string('document_number')->nullable();
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamps();

            $table->index(['driver_profile_id', 'driver_document_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_documents');
    }
};