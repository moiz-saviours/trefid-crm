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
        if (!Schema::hasTable('payment_merchants')) {
            Schema::create('payment_merchants', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('brand_key')->nullable()->default(null);
                $table->string('name')->nullable()->default(null);
                $table->string('vendor_name')->nullable()->default(null);
                $table->string('type')->nullable()->default(null);
                $table->string('descriptor')->nullable()->default(null);
                $table->string('email')->nullable()->default(null);
                $table->string('login_id')->nullable()->default(null);
                $table->string('transaction_key')->nullable()->default(null);
                $table->string('test_login_id')->nullable()->default(null);
                $table->string('test_transaction_key')->nullable()->default(null);
                $table->integer('limit')->nullable()->default(null);
                $table->integer('capacity')->nullable()->default(null);
                $table->enum('environment', ['production', 'sandbox'])->default('sandbox');
                $table->integer('status')->nullable()->default(1)->comment('0 = inactive, 1 = active, 2 = suspended');
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('brand_key')->references('brand_key')->on('brands')->onDelete('NO ACTION');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_merchants');
    }
};
