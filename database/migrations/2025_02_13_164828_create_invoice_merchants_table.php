<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Matheus Daniel Update
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('invoice_merchants')) {
            Schema::create('invoice_merchants', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_key')->nullable()->default(null);
                $table->string('merchant_type')->nullable()->default(null);
                $table->unsignedBigInteger('merchant_id')->nullable()->default(null);
                $table->timestamps();
                $table->foreign('invoice_key')->references('invoice_key')->on('invoices')->onDelete('cascade');
                $table->foreign('merchant_id')->references('id')->on('payment_merchants')->onDelete('cascade');
                $table->index(['merchant_type', 'merchant_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_merchants');
    }
};
