<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->enum('satisfaction_level', ['1', '2', '3', '4', '5']);
            $table->text('feedback')->nullable();
            $table->enum('service_area', ['ventas', 'servicio_tecnico', 'atencion_cliente']);
            $table->enum('recommendation_level', ['si', 'no', 'talvez']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
