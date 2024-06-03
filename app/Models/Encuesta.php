<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $primaryKey = 'id_encuesta';
    protected $fillable = ['nombre', 'genero', 'descripcion', 'imagen'];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'id_encuesta', 'id_encuesta');
    }

    public function generoRelacion()
    {
        return $this->belongsTo(Genero::class, 'genero');
    }
}
