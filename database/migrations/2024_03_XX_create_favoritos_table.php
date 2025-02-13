<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('anuncio_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Garante que um usuário não pode favoritar o mesmo anúncio mais de uma vez
            $table->unique(['user_id', 'anuncio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
}; 