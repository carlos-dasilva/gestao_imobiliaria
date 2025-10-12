<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'email',
        'phone',
        'creci',
        'logo_path',
        'favicon_path',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'whatsapp_url',
        'system_log_enabled',
        'primary_color',
        'secondary_color',
        'background_color',
    ];
}
