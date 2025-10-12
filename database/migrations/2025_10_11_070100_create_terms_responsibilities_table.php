<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('terms_responsibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('terms_page_id')->constrained('terms_pages')->cascadeOnDelete();
            $table->string('text');
            $table->unsignedSmallInteger('position')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terms_responsibilities');
    }
};

