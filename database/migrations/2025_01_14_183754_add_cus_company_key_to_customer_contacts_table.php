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
        Schema::table('customer_contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('customer_contacts', 'cus_company_key')) {
                $table->unsignedBigInteger('cus_company_key')->nullable()->default(null)->after('special_key');
                $table->foreign('cus_company_key')->references('special_key')->on('customer_companies')->onDelete('SET NULL');
                if (!Schema::hasIndex('customer_contacts', ['cus_company_key'], 'unique')) {
                    $table->index('cus_company_key');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_contacts', function (Blueprint $table) {
            //
        });
    }
};
