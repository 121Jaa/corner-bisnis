<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            // Jika kolom sudah ada, jangan tambahkan lagi
            $columns = Schema::getColumnListing('businesses');
            
            if (!in_array('image', $columns)) {
                $table->string('image')->nullable();
            }
            if (!in_array('type', $columns)) {
                $table->string('type')->nullable()->after('name');
            }
            if (!in_array('address', $columns)) {
                $table->string('address')->nullable();
            }
            if (!in_array('phone', $columns)) {
                $table->string('phone')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn(['image', 'type', 'address', 'phone']);
        });
    }
};