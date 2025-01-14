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
        if (!Schema::hasTable('assign_company_contacts')) {
            Schema::create('assign_company_contacts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cus_company_key')->nullable()->default(null);
                $table->unsignedBigInteger('cus_contact_key')->nullable()->default(null);
                $table->timestamps();

                $table->foreign('cus_company_key')->references('special_key')->on('customer_companies')->onDelete('NO ACTION');
                $table->foreign('cus_contact_key')->references('special_key')->on('customer_contacts')->onDelete('NO ACTION');

                $table->index('cus_company_key');
                $table->index('cus_contact_key');
                $table->unique(['cus_company_key', 'cus_contact_key']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_company_contacts');
    }
};
