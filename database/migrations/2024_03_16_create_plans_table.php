<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->integer('max_ads');
            $table->integer('max_photos');
            $table->integer('max_videos');
            $table->integer('boosts_per_week');
            $table->string('boost_type'); // padrão, destacado, super_destaque
            $table->boolean('has_verification_seal')->default(false);
            $table->boolean('has_priority_support')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
}; 