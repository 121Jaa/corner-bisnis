<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            // Ubah tipe kolom dari VARCHAR(255) menjadi TEXT
            $table->text('google_maps_link')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            // Kembalikan ke string(1000) jika rollback
            $table->string('google_maps_link', 1000)->nullable()->change();
        });
    }
};