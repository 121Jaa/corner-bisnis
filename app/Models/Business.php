<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Business extends Model
{
    protected $fillable = [
        'name',
        'type',
        'category_id',
        'description',
        'address',
        'google_maps_link',  // <- ganti dari latitude/longitude
        'phone',
        'facilities',
        'image'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
