<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPurposeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'privacy_policy_id',
        'text',
        'position',
    ];

    public function policy()
    {
        return $this->belongsTo(PrivacyPolicy::class, 'privacy_policy_id');
    }
}

