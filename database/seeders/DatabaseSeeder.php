<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // Criar usuários padrão
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('killbill1020'),
        ]);
        $admin->assignRole('admin');

        $acompanhante = User::factory()->create([
            'name' => 'Acompanhante',
            'email' => 'acompanhante@gmail.com',
            'password' => Hash::make('killbill1020'),
        ]);
        $acompanhante->assignRole('acompanhante');

        $cliente = User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('killbill1020'),
        ]);
        $cliente->assignRole('cliente');
    }
}
