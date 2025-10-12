<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_intro',
        'bases_legais',
        'compartilhamento',
        'retencao',
        'direitos_titular',
        'seguranca',
        'cookies',
        'atualizacoes',
    ];

    public function collectedItems()
    {
        return $this->hasMany(PrivacyCollectedItem::class)->orderBy('position')->orderBy('id');
    }

    public function purposes()
    {
        return $this->hasMany(PrivacyPurposeItem::class)->orderBy('position')->orderBy('id');
    }
}

