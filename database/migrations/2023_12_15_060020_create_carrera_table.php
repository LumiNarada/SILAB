<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carrera', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insertar datos iniciales
        DB::table('carrera')->insert([
            ['nombre' => 'Ingeniería Aeroespacial'],
            ['nombre' => 'Ingeniería Civil'],
            ['nombre' => 'Ingeniería Geomática'],
            ['nombre' => 'Ingeniería Ambiental'],
            ['nombre' => 'Ingeniería Geofísica'],
            ['nombre' => 'Ingeniería Geológica'],
            ['nombre' => 'Ingeniería Petrolera'],
            ['nombre' => 'Ingeniería de Minas y Metalurgia'],
            ['nombre' => 'Ingeniería en Computación'],
            ['nombre' => 'Ingeniería Eléctrica Electrónica'],
            ['nombre' => 'Ingeniería en Telecomunicaciones'],
            ['nombre' => 'Ingeniería Mecánica'],
            ['nombre' => 'Ingeniería Industrial'],
            ['nombre' => 'Ingeniería Mecatrónica'],
            ['nombre' => 'Ingeniería en Sistemas Biomédicos'],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrera');
    }
};
