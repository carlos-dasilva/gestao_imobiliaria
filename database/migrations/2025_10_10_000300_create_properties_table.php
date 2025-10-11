<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('area')->default(0); // metragem (m²)
            $table->unsignedSmallInteger('bedrooms')->default(0);
            $table->unsignedSmallInteger('bathrooms')->default(0);
            $table->unsignedSmallInteger('garages')->default(0);
            $table->string('city');
            $table->string('state', 2);
            $table->string('address')->nullable();
            $table->string('status')->default('Disponível'); // Disponível, Indisponível, Alugado, Vendido
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

