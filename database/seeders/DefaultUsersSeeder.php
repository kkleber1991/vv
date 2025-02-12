<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar planos
        $planFree = Plan::where('name', 'Free')->first();
        $planVip = Plan::where('name', 'VIP')->first();
        $planPremium = Plan::where('name', 'Premium')->first();

        // Cria o papel de admin se não existir
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $acompanhanteRole = Role::firstOrCreate(['name' => 'acompanhante']);

        // Cria o usuário admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'plan_id' => $planVip->id,
            ]
        );

        // Atribui o papel de admin
        $admin->assignRole($adminRole);

        // Cria um usuário acompanhante de teste
        $acompanhante = User::firstOrCreate(
            ['email' => 'acompanhante@test.com'],
            [
                'name' => 'Acompanhante Teste',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'plan_id' => $planPremium->id,
            ]
        );

        // Atribui o papel de acompanhante
        $acompanhante->assignRole($acompanhanteRole);

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