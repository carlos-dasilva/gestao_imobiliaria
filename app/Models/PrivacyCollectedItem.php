<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyCollectedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'privacy_policy_id',
        'title',
        'description',
        'position',
    ];

    public function policy()
    {
        return $this->belongsTo(PrivacyPolicy::class, 'privacy_policy_id');
    }
}

