<?php

namespace App\Traits;

use App\Models\AnuncioView;

trait HasViews
{
    public function registerView()
    {
        $ip = request()->ip();
        $userId = auth()->id();
        
        // Verifica se já existe uma visualização do mesmo IP nas últimas 24h
        $existingView = $this->views()
            ->where(function ($query) use ($ip, $userId) {
                $query->where('ip_address', $ip)
                    ->orWhere('user_id', $userId);
            })
            ->where('created_at', '>=', now()->subHours(24))
            ->exists();

        if (!$existingView) {
            return $this->views()->create([
                'ip_address' => $ip,
                'user_id' => $userId
            ]);
        }

        return false;
    }

    public function views()
    {
        return $this->hasMany(AnuncioView::class);
    }
} 