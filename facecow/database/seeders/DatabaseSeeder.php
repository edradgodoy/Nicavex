<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Limpiar y crear usuario administrativo de prueba
        User::where('email', 'admin@facecow.com')->delete();
        User::factory()->create([
            'name' => 'Administrador Nicavex',
            'email' => 'admin@facecow.com',
            'password' => bcrypt('password'),
        ]);

        // Crear registros de ganado de prueba
        \App\Models\Admin\Cattle::truncate();
        \App\Models\Admin\Cattle::factory(25)->create();
    }
}
