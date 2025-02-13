<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\HasViews;

class Anuncio extends Model
{
    use HasFactory, HasViews;

    protected $fillable = [
        'titulo',
        'slug',
        'descricao',
        'valor_30min',
        'valor_1hr',
        'valor_2hr',
        'valor_3hr',
        'whatsapp',
        'cidade',
        'estado',
        'status',
        'is_destaque',
        'nome',
        'idade',
        'tipo',
        'peso',
        'nacionalidade',
        'horario_inicio',
        'horario_fim',
        'atende',
        'servicos',
        'extras',
        'locais_atendimento',
        'formas_pagamento',
        'linguas',
        'user_id',
        'foto_principal'
    ];

    protected $casts = [
        'is_destaque' => 'boolean',
        'atende' => 'array',
        'servicos' => 'array',
        'extras' => 'array',
        'locais_atendimento' => 'array',
        'formas_pagamento' => 'array',
        'linguas' => 'array',
        'horario_inicio' => 'datetime',
        'horario_fim' => 'datetime',
        'peso' => 'decimal:2',
        'valor_30min' => 'decimal:2',
        'valor_1hr' => 'decimal:2',
        'valor_2hr' => 'decimal:2',
        'valor_3hr' => 'decimal:2'
    ];

    // Arrays com as opções disponíveis
    public static $servicosDisponiveis = [
        'Beijos na boca', 'Fetichismo', 'Atenção à casais', 'Oral com camisinha',
        'Oral sem camisinha', 'Squirting', 'Sado submissa', 'Chuva dourada',
        'Beijo gregro', 'Cubana', 'Sexo anal', 'Garganta profunda', 'Lésbica',
        'Beijo branco', 'Ejaculação corpo', 'Namoradinha', 'Oral até o final',
        'Duplas', 'Sado dominadora', 'Fantasias e figurinos', 'Massagem erótica',
        'Strap on', 'Trios', 'Ejaculação facial', 'PSE', 'Sado suave', 'Sado duro',
        'Lingerie', 'Festas e eventos', 'Fisting Anal', 'Atenção à deficientes físicos',
        'Atenção à mulheres', 'Despedida de solteiro', 'Orgia', 'Face fucking',
        'Fisting vaginal', 'Sexcam'
    ];

    public static $extrasDisponiveis = [
        'Whatsapp', 'Email visível', 'Aceita gravação', 'Coroas', 'Peitudas',
        'Mulatas', 'Negras', 'Ninfetas'
    ];

    public static $locaisAtendimentoDisponiveis = [
        'Hotel', 'A Domicilio', 'Com local', 'Viagem'
    ];

    public static $formasPagamentoDisponiveis = [
        'Cartão de crédito', 'Cartão de débito', 'PIX', 'Transferencia bancária'
    ];

    public static $linguasDisponiveis = [
        'Português', 'Inglês', 'Espanhol', 'Italiano', 'Francês', 'Outros'
    ];

    public static $atendeDisponiveis = [
        'ele', 'ela', 'casais', 'grupo', 'trans'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($anuncio) {
            $anuncio->slug = Str::slug($anuncio->titulo);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAtivos($query)
    {
        return $query->where('status', 'ativo');
    }

    public function fotos()
    {
        return $this->hasMany(AnuncioFoto::class);
    }

    public function videos()
    {
        return $this->hasMany(AnuncioVideo::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }
} 