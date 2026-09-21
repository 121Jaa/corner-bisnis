<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Business extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'category_id',
        'description',
        'address',
        'google_maps_link',
        'phone',
        'facilities',
        'image',
        'images',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ⭐ ============ HELPER ============

    public function isAssigned(): bool
    {
        return $this->user_id !== null;
    }

    public function getOwnerNameAttribute(): string
    {
        return $this->user?->display_name
            ?? $this->user?->name
            ?? '— Belum di-assign —';
    }

    public function getCategoryNameAttribute(): string
    {
        return $this->category?->name ?? 'Tanpa kategori';
    }
}
