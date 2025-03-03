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
        Schema::table('payment_transaction_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_transaction_logs', 'ip_address')) {
                $table->string('ip_address')->nullable()->default(null);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transaction_logs', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'ip_address')) {
                $table->dropColumn('ip_address');
            }
        });
    }
};
