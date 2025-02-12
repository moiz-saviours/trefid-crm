<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payment_merchants', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_merchants' , 'payment_method')) {
                $table->enum('payment_method', ['authorize', 'stripe', 'credit card', 'bank transfer', 'paypal', 'cash', 'other'])->default('authorize')->after('brand_key');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_merchants', function (Blueprint $table) {
            if (Schema::hasColumn('payment_merchants' , 'payment_method')) {
                $table->dropColumn('payment_method');
            }
        });
    }
};
