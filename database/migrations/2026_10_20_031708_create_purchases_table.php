<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onDelete('restrict'); // Data dari supplier K-Pop
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // Staff yang mencatat
            $table->string('purchase_number')->unique();
            $table->decimal('total', 15, 2)->default(0);
            $table->string('status')->default('completed');
            $table->timestamp('purchased_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};