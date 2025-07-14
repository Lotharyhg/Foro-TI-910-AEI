<?php
// Esta migración añade una columna 'title' a la tabla 'posts' para almacenar el título del post by Michelle Adriana Flores Mora
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
        Schema::table('posts', function (Blueprint $table) {
          $table->string('title')->nullable();  // Añadir columna 'title' para almacenar el título del post by Michelle Adriana Flores Mora
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('title'); // Eliminar columna 'title' si se revierte la migración by Michelle Adriana Flores Mora
        });
    }
};
