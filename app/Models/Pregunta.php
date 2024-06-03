<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'preguntas';

    protected $primaryKey = 'id';

    protected $fillable = ['pregunta', 'id_encuesta', 'si', 'no', 'imagen', 'tiempo'];

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'id_encuesta');
    }
}

