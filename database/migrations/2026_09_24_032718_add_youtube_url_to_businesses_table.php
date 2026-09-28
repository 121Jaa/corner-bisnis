<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_add_youtube_url_to_businesses_table.php
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('youtube_url')->nullable()->after('facilities');
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
        });
    }
};
