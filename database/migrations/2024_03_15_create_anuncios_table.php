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
            
            // Informações básicas
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descricao');
            
            // Valores por tempo
            $table->decimal('valor_30min', 10, 2)->nullable();
            $table->decimal('valor_1hr', 10, 2)->nullable();
            $table->decimal('valor_2hr', 10, 2)->nullable();
            $table->decimal('valor_3hr', 10, 2)->nullable();
            
            // Contato e Localização
            $table->string('whatsapp');
            $table->string('cidade');
            $table->string('estado');
            
            // Status e Destaque
            $table->string('status')->default('ativo'); // ativo, inativo
            $table->boolean('is_destaque')->default(false);

            // Informações Pessoais
            $table->string('nome');
            $table->integer('idade');
            $table->enum('tipo', ['homem', 'mulher', 'trans']);
            $table->decimal('peso', 5, 2)->nullable();
            $table->enum('nacionalidade', [
                'Brasileira',
                'Boliviana',
                'Francesa',
                'Italiana',
                'Japonesa',
                'Portuguesa',
                'Cubana',
                'Venezuelana',
                'Outros'
            ]);

            // Horário de Atendimento
            $table->time('horario_inicio');
            $table->time('horario_fim');

            // Arrays de Opções
            $table->json('atende'); // ele, ela, casais, grupo, trans
            $table->json('servicos');
            $table->json('extras');
            $table->json('locais_atendimento');
            $table->json('formas_pagamento');
            $table->json('linguas');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
}; 