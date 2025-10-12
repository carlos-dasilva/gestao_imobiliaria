<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'who_i_am',
        'purpose',
        'how_i_work',
    ];

    public function values()
    {
        return $this->hasMany(AboutValue::class)->orderBy('position')->orderBy('id');
    }
}

