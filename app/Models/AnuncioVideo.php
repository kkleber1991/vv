<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnuncioVideo extends Model
{
    protected $fillable = ['path'];

    public function anuncio(): BelongsTo
    {
        return $this->belongsTo(Anuncio::class);
    }
} 