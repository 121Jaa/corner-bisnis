<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('facilities')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('facilities')->nullable(false)->change();
        });
    }
};