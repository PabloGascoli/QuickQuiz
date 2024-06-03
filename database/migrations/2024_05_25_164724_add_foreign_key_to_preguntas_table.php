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
        Schema::table('preguntas', function (Blueprint $table) {
            // Agregar clave foránea solo si no existe
            if (!Schema::hasColumn('preguntas', 'id_encuesta')) {
                $table->unsignedBigInteger('id_encuesta')->after('pregunta');
            }
            // Añadir la clave foránea
            $table->foreign('id_encuesta')->references('id_encuesta')->on('encuestas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preguntas', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['id_encuesta']);
            // Eliminar la columna solo si fue agregada en esta migración
            if (Schema::hasColumn('preguntas', 'id_encuesta')) {
                $table->dropColumn('id_encuesta');
            }
        });
    }
};
