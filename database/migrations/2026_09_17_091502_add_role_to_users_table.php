<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 'admin' atau 'user'
            $table->string('role')->default('user')->after('email');
            // Nama tampilan (misal "Budi Santoso")
            $table->string('display_name')->nullable()->after('role');
            // Status akun
            $table->boolean('is_active')->default(true)->after('display_name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'display_name', 'is_active']);
        });
    }
};