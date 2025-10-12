<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('terms_pages', function (Blueprint $table) {
            $table->id();
            $table->text('terms_intro')->nullable();
            $table->text('services')->nullable();
            $table->text('intellectual_property')->nullable();
            $table->text('communications')->nullable();
            $table->text('privacy')->nullable();
            $table->text('forum')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terms_pages');
    }
};

