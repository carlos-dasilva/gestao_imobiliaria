<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('primary_color', 20)->nullable()->after('system_log_enabled');
            $table->string('secondary_color', 20)->nullable()->after('primary_color');
            $table->string('background_color', 20)->nullable()->after('secondary_color');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['primary_color','secondary_color','background_color']);
        });
    }
};

