<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class, // Primeiro cria as roles e permissões
            PlansSeeder::class, // Depois cria os planos
            DefaultUsersSeeder::class, // Por último cria os usuários
        ]);
    }
}
