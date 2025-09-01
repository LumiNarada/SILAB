<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumno extends Model
{
    use HasFactory;
    public function sesion()
    {
        return $this->belongsTo(Sesion::class, 'sesion_id');
    }
    protected $table = 'alumno';
}
