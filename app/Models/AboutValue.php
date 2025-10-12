<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_page_id',
        'value',
        'position',
    ];

    public function page()
    {
        return $this->belongsTo(AboutPage::class, 'about_page_id');
    }
}

