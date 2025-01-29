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

            if (!Schema::hasColumn('payment_merchants', 'c_contact_key')) {
                $table->unsignedBigInteger('c_contact_key')->nullable()->default(null)->after('id');
                $table->foreign('c_contact_key')->references('special_key')->on('client_contacts')->onDelete('SET NULL');
                if (!Schema::hasIndex('client_contacts', ['c_contact_key'], 'unique')) {
                    $table->index('c_contact_key', 'payment_merchants_c_contact_key_index');
                }
            }
            if (!Schema::hasColumn('payment_merchants', 'c_company_key')) {
                $table->unsignedBigInteger('c_company_key')->nullable()->default(null)->after('c_contact_key');
                $table->foreign('c_company_key')->references('special_key')->on('client_companies')->onDelete('SET NULL');
                if (!Schema::hasIndex('client_companies', ['c_company_key'], 'unique')) {
                    $table->index('c_company_key', 'payment_merchants_c_company_key_index');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_merchants', function (Blueprint $table) {
            if (Schema::hasColumn('payment_merchants', 'c_contact_key')) {
                $table->dropForeign(['c_contact_key']);
                $table->dropIndex('payment_merchants_c_contact_key_index');
                $table->dropColumn('c_contact_key');
            }

            if (Schema::hasColumn('payment_merchants', 'c_company_key')) {
                $table->dropForeign(['c_company_key']);
                $table->dropIndex('payment_merchants_c_company_key_index');
                $table->dropColumn('c_company_key');
            }
        });
    }
};
