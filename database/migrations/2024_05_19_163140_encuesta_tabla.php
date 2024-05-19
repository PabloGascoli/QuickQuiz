<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestasTable extends Migration
{
    public function up(): void
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id('id_encuesta'); // Primary key
            $table->string('nombre');
            $table->string('genero');
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
}
