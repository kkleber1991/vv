<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar planos
        $planFree = Plan::where('name', 'Free')->first();
        $planVip = Plan::where('name', 'VIP')->first();
        $planPremium = Plan::where('name', 'Premium')->first();

        // Criar usuário Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
            'plan_id' => $planVip->id,
        ])->assignRole('admin');

        // Criar usuário Acompanhante
        User::create([
            'name' => 'Acompanhante',
            'email' => 'acompanhante@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
            'plan_id' => $planPremium->id,
        ])->assignRole('acompanhante');

        // Criar usuário Cliente
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('killbill1020'),
            'email_verified_at' => now(),
            'plan_id' => $planFree->id,
        ])->assignRole('cliente');
    }
} 