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
        Schema::create('cattles', function (Blueprint $table) {
            $table->id();
            $table->string('arete')->unique(); // ID / Tag de oreja
            $table->string('breed');            // Raza
            $table->decimal('weight', 8, 2);    // Peso en kg
            $table->string('health_status');    // Estado de salud
            $table->string('origin');           // verificado / no verificado
            $table->decimal('latitude', 10, 8); // Latitud GPS
            $table->decimal('longitude', 11, 8);// Longitud GPS
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattles');
    }
};
