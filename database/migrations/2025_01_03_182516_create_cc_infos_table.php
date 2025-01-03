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
        if (!Schema::hasTable('cc_infos')) {
            Schema::create('cc_infos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('special_key')->nullable()->default(null);
                $table->unsignedBigInteger('cus_contact_key')->nullable()->default(null);
                $table->unsignedBigInteger('invoice_key')->nullable()->default(null);
                $table->string('card_name')->nullable()->default(null);
                $table->string('card_type')->nullable()->default(null);
                $table->string('card_number')->nullable()->default(null);
                $table->string('card_cvv')->nullable()->default(null);
                $table->string('card_month_expiry', 2)->nullable()->default(null);
                $table->string('card_year_expiry', 4)->nullable()->default(null);
                $table->string('address')->nullable()->default(null);
                $table->string('city')->nullable()->default(null);
                $table->string('state')->nullable()->default(null);
                $table->string('country')->nullable()->default(null);
                $table->string('zipcode')->nullable()->default(null);
                $table->tinyInteger('status')->nullable()->default(0)->comment('0 = inactive, 1 = active');
                $table->softDeletes();
                $table->timestamps();


                $table->index('special_key');
                $table->index('cus_contact_key');

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
        Schema::dropIfExists('cc_infos');
    }
};
