<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
        ])->assignRole('admin');

        // Criar usuário Acompanhante
        User::create([
            'name' => 'Acompanhante',
            'email' => 'acompanhante@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
        ])->assignRole('acompanhante');

        // Criar usuário Cliente
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
        ])->assignRole('cliente');
    }
} 