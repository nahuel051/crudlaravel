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
        Schema::create('futbol', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('edad');
            // Clave foránea: establece relación con tabla 'teams'
            // constrained() detecta automáticamente la PK 'id' de teams
            // onDelete('cascade'): al eliminar un equipo, se borran sus jugadores relacionados
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     * Se ejecuta al deshacer la migración (rollback):
     * - php artisan migrate:rollback
     * - php artisan migrate:reset
     * Elimina la tabla 'futbol' si existe, revertiendo los cambios de up()
     */
    public function down(): void
    {
        Schema::dropIfExists('futbol');
    }
};
