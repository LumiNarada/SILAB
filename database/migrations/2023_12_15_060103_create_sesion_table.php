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
        Schema::create('sesion', function (Blueprint $table) {
            $table->id();
            $table->string('aula');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('practica_id');
            $table->foreign('practica_id')->references('id')->on('practica');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion');
    }
};
