<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono', 20)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('empleada_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleada_id')->constrained('empleadas')->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['empleada_id', 'servicio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleada_servicio');
        Schema::dropIfExists('empleadas');
    }
};