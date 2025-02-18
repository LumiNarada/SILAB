<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sesion extends Model
{
    use HasFactory;
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'sesion_id');
    }
    protected $table = 'sesion';
}
