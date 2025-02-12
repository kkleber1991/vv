<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    public function run(): void
    {
        // Plano Free
        Plan::create([
            'name' => 'Free',
            'price' => 0,
            'description' => 'Perfeito para testar nossa plataforma',
            'max_ads' => 1,
            'max_photos' => 5,
            'max_videos' => 0,
            'boosts_per_week' => 0,
            'boost_type' => 'padrao',
            'has_verification_seal' => false,
            'has_priority_support' => false,
            'is_popular' => false
        ]);

        // Plano Básico
        Plan::create([
            'name' => 'Básico',
            'price' => 39.90,
            'description' => 'Perfeito para começar sua divulgação',
            'max_ads' => 2,
            'max_photos' => 7,
            'max_videos' => 1,
            'boosts_per_week' => 1,
            'boost_type' => 'padrao',
            'has_verification_seal' => false,
            'has_priority_support' => false,
            'is_popular' => false
        ]);

        // Plano Premium
        Plan::create([
            'name' => 'Premium',
            'price' => 89.90,
            'description' => 'O melhor custo-benefício',
            'max_ads' => 3,
            'max_photos' => 15,
            'max_videos' => 3,
            'boosts_per_week' => 2,
            'boost_type' => 'destacado',
            'has_verification_seal' => false,
            'has_priority_support' => false,
            'is_popular' => true
        ]);

        // Plano VIP
        Plan::create([
            'name' => 'VIP',
            'price' => 119.90,
            'description' => 'Máxima visibilidade e destaque',
            'max_ads' => 4,
            'max_photos' => 30,
            'max_videos' => 10,
            'boosts_per_week' => 4,
            'boost_type' => 'super_destaque',
            'has_verification_seal' => true,
            'has_priority_support' => true,
            'is_popular' => false
        ]);
    }
} 