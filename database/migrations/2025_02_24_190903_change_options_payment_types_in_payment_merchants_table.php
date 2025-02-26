<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payment_merchants', function (Blueprint $table) {
            if (Schema::hasColumn('payment_merchants', 'payment_method')) {
                DB::statement("ALTER TABLE `payment_merchants` MODIFY COLUMN `payment_method` ENUM('authorize', 'stripe', 'credit card', 'bank transfer', 'paypal', 'cash', 'edp', 'other') NOT NULL");
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_merchants', function (Blueprint $table) {
            if (Schema::hasColumn('payment_merchants', 'payment_method')) {
                DB::statement("ALTER TABLE `payment_merchants` MODIFY COLUMN `payment_method` ENUM('authorize', 'stripe', 'credit card', 'bank transfer', 'paypal', 'cash','other') NOT NULL");
            }
        });
    }
};
