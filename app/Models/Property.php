<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_type_id',
        'title',
        'slug',
        'description',
        'price',
        'area',
        'bedrooms',
        'bathrooms',
        'garages',
        'city',
        'state',
        'address',
        'status',
        'views',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'area' => 'integer',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'garages' => 'integer',
        'views' => 'integer',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function coverImage(): ?PropertyImage
    {
        return $this->images()->where('is_cover', true)->first();
    }
}

