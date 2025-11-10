<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'provider', 'video_id', 'url', 'is_cover', 'sort_order'
    ];

    protected $casts = [
        'is_cover' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function getEmbedUrlAttribute(): string
    {
        if ($this->provider === 'youtube') {
            return 'https://www.youtube.com/embed/'.$this->video_id.'?rel=0&modestbranding=1';
        }
        return $this->url;
    }

    public function getThumbUrlAttribute(): string
    {
        if ($this->provider === 'youtube') {
            return "https://i.ytimg.com/vi/{$this->video_id}/hqdefault.jpg";
        }
        return '';
    }
}

