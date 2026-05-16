<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        Alumno::factory()
            ->count(30)
            ->create();
    }
}
