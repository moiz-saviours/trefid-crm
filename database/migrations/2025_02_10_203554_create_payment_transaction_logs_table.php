<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Matheus Daniel Update
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('payment_transaction_logs')) {
            Schema::create('payment_transaction_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_key')->nullable()->default(null);
                $table->unsignedBigInteger('cus_contact_key')->nullable()->default(null);
                $table->unsignedBigInteger('merchant_id')->nullable()->default(null);
                $table->string('merchant_type')->nullable()->default(null);
                $table->string('gateway')->comment('authorize, stripe, paypal, etc.');
                $table->string('transaction_id')->nullable();
                $table->string('auth_code')->nullable()->comment('Authorization Code if applicable');
                $table->json('response')->nullable();
                $table->json('transaction_response')->nullable();
                $table->string('response_code')->nullable();
                $table->string('response_message')->nullable();
                $table->json('request_data')->nullable()->comment('Raw request data');
                $table->decimal('amount', 16, 2);
                $table->string('currency', 10)->default('USD');
                $table->string('status')->default(null);
                $table->text('error_message')->nullable()->default(null);
                $table->softDeletes();
                $table->timestamps();

                // Foreign key constraints
                $table->foreign('merchant_id')->references('id')->on('payment_merchants')->onDelete('NO ACTION');
                $table->foreign('cus_contact_key')->references('special_key')->on('customer_contacts')->onDelete('NO ACTION');
                $table->foreign('invoice_key')->references('invoice_key')->on('invoices')->onDelete('NO ACTION');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transaction_logs');
    }
};
