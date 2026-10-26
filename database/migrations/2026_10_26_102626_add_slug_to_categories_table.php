<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Pastikan kolom slug ditambahkan dan bisa bernilai nullable untuk mencegah error
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};