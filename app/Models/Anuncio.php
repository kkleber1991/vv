<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'descricao',
        'valor',
        'whatsapp',
        'cidade',
        'estado',
        'status',
        'user_id'
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
} 