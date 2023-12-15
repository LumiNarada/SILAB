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
        Schema::create('practica', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->smallInteger('orden');
            $table->text('indicaciones');
            $table->string('manual');
            $table->string('previo');
            $table->unsignedBigInteger('asignatura_id');
            $table->foreign('asignatura_id')->references('id')->on('asignatura');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practica');
    }
};
