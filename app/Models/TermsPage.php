<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'terms_intro',
        'services',
        'intellectual_property',
        'communications',
        'privacy',
        'forum',
    ];

    public function responsibilities()
    {
        return $this->hasMany(TermsResponsibility::class)->orderBy('position')->orderBy('id');
    }
}

