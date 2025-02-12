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
        // Primeiro executamos o seeder de roles e permissões
        $this->call([
            RolesAndPermissionsSeeder::class,
            DefaultUsersSeeder::class,
        ]);
    }
}
