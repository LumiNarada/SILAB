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
        Schema::create('alumno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numeroCuenta');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('grupo');
            $table->unsignedBigInteger('sesion_id');
            $table->smallInteger('calificacion')->default(0);
            $table->foreign('sesion_id')->references('id')->on('sesion')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
