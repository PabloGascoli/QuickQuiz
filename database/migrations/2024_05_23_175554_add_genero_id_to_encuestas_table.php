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
        Schema::table('encuestas', function (Blueprint $table) {
            $table->unsignedBigInteger('genero')->change(); // Asegurarse de que el campo es del tipo correcto
            $table->foreign('genero')->references('id')->on('generos')->onDelete('cascade'); // Agregar la clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuestas', function (Blueprint $table) {
            $table->dropForeign(['genero']); // Eliminar la clave foránea
        });
    }
};
