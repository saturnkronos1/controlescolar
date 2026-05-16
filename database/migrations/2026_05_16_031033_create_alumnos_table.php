<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {

            $table->id();

            $table->string('matricula')->unique();

            $table->string('nombre');

            $table->string('apellido_paterno');

            $table->string('apellido_materno')
                ->nullable();

            $table->string('curp')
                ->unique();

            $table->date('fecha_nacimiento');

            $table->enum('sexo', [
                'Hombre',
                'Mujer',
            ]);

            $table->string('telefono')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->text('direccion')
                ->nullable();

            $table->foreignId('ciclo_escolar_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('grado_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('grupo_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('tutor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->boolean('activo')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
