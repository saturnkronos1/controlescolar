<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CicloEscolar;
use App\Models\Grado;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    public function definition(): array
    {
        return [

            'matricula' => fake()->unique()
                ->numerify('ALU###'),

            'nombre' => fake()->firstName(),

            'apellido_paterno' => fake()->lastName(),

            'apellido_materno' => fake()->lastName(),

            'curp' => strtoupper(
                fake()->bothify('????######H??***#')
            ),

            'fecha_nacimiento' => fake()
                ->date(),

            'sexo' => fake()
                ->randomElement([
                    'Hombre',
                    'Mujer',
                ]),

            'telefono' => fake()
                ->phoneNumber(),

            'email' => fake()
                ->safeEmail(),

            'direccion' => fake()
                ->address(),

            'ciclo_escolar_id' => CicloEscolar::query()
                ->inRandomOrder()
                ->value('id'),

            'grado_id' => Grado::query()
                ->inRandomOrder()
                ->value('id'),

            'grupo_id' => Grupo::query()
                ->inRandomOrder()
                ->value('id'),

            'tutor_id' => User::role('Tutor')
                ->inRandomOrder()
                ->value('id'),

            'activo' => true,
        ];
    }
}
