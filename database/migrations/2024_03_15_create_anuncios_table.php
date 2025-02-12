<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descricao');
            $table->decimal('valor', 10, 2);
            $table->string('whatsapp');
            $table->string('cidade');
            $table->string('estado');
            $table->string('status')->default('ativo'); // ativo, inativo
            $table->boolean('is_destaque')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
}; 