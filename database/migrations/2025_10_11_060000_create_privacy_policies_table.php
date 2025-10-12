<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privacy_policies', function (Blueprint $table) {
            $table->id();
            $table->text('policy_intro')->nullable();
            $table->text('bases_legais')->nullable();
            $table->text('compartilhamento')->nullable();
            $table->text('retencao')->nullable();
            $table->text('direitos_titular')->nullable();
            $table->text('seguranca')->nullable();
            $table->text('cookies')->nullable();
            $table->text('atualizacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privacy_policies');
    }
};

