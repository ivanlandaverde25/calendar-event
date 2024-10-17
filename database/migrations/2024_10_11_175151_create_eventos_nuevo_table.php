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
        Schema::create('eventos_nuevo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('grupo');
            $table->string('responsable');
            $table->string('estado');
            $table->string('prioridad');
            $table->date('fecha_creacion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_nuevo');
    }
};
