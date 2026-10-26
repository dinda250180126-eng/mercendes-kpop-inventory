<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Memastikan semua kolom yang sering dicari controller benar-benar ada
            if (!Schema::hasColumn('transactions', 'reference_number')) {
                $table->string('reference_number')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'transaction_date')) {
                $table->timestamp('transaction_date')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'product_id')) {
                $table->unsignedBigInteger('product_id')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'type')) {
                $table->string('type')->nullable(); // in atau out
            }
            if (!Schema::hasColumn('transactions', 'quantity')) {
                $table->integer('quantity')->default(1);
            }
            if (!Schema::hasColumn('transactions', 'total_price')) {
                $table->decimal('total_price', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('transactions', 'customer_name')) {
                $table->string('customer_name')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'customer_phone')) {
                $table->string('customer_phone')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'customer_address')) {
                $table->text('customer_address')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'reference_number', 
                'transaction_date', 
                'user_id', 
                'product_id', 
                'type', 
                'quantity', 
                'total_price', 
                'customer_name', 
                'customer_phone', 
                'customer_address'
            ]);
        });
    }
};
