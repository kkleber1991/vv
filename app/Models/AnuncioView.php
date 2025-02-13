<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnuncioView extends Model
{
    protected $fillable = [
        'anuncio_id',
        'user_id',
        'ip_address'
    ];

    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 