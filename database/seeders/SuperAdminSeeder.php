<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'email' => 'admin@controlescolar.test',
            ],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole('Super Admin');
    }
}
