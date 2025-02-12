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
        // Primeiro executamos o seeder de roles e permissões
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // Criar usuários padrão
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $acompanhante = User::create([
            'name' => 'Acompanhante',
            'email' => 'acompanhante@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
        ]);
        $acompanhante->assignRole('acompanhante');

        $cliente = User::create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
        ]);
        $cliente->assignRole('cliente');
    }
}
