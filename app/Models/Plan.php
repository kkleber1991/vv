<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'max_ads',
        'max_photos',
        'max_videos',
        'boosts_per_week',
        'boost_type',
        'has_verification_seal',
        'has_priority_support',
        'is_popular'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'has_verification_seal' => 'boolean',
        'has_priority_support' => 'boolean',
        'is_popular' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($plan) {
            $plan->slug = Str::slug($plan->name);
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
} 