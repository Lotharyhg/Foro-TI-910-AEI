<?php
/**
* Migracion para agregar la columna 'image' a la tabla 'posts'.
* Esta columna alamacenara la ruta asociada a la imagen del post 
* By Michelle Adriana Flores Mora
**/
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
            $table->string('image')->nullable()->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
                    $table->dropColumn('image');
        });
    }
};
