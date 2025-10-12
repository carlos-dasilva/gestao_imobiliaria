<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsResponsibility extends Model
{
    use HasFactory;

    protected $fillable = [
        'terms_page_id',
        'text',
        'position',
    ];

    public function page()
    {
        return $this->belongsTo(TermsPage::class, 'terms_page_id');
    }
}

