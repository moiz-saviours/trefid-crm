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
        Schema::table('invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('invoices', 'due_date')) {
                $table->date('due_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'))->after('description');
            }
            if (!Schema::hasColumn('invoices' , 'currency')) {
                $table->enum('currency', ['USD', 'GBP', 'AUD', 'CAD'])->nullable()->default('USD')->after('due_date');
            }
            if (!Schema::hasColumn('invoices', 'taxable')) {
                $table->boolean('taxable')->nullable()->default(false)->after('amount');
            }
            if (!Schema::hasColumn('invoices' , 'tax_type')) {
                $table->enum('tax_type', ['none','percentage', 'fixed'])->nullable()->default('none')->after('taxable');
            }
            if (!Schema::hasColumn('invoices' , 'tax_value')) {
                $table->integer('tax_value')->nullable()->default(0)->after('tax_type');
            }
            if (!Schema::hasColumn('invoices' , 'tax_amount')) {
                $table->decimal('tax_amount', 16, 2)->nullable()->default(0.00)->after('tax_value');
            }
            if (!Schema::hasColumn('invoices' , 'total_amount')) {
                $table->decimal('total_amount', 16, 2)->nullable()->default(0.00)->after('tax_amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'due_date')) {
                $table->dropColumn('due_date');
            }
            if (Schema::hasColumn('invoices', 'currency')) {
                $table->dropColumn('currency');
            }
            if (Schema::hasColumn('invoices', 'taxable')) {
                $table->dropColumn('taxable');
            }
            if (Schema::hasColumn('invoices', 'tax_type')) {
                $table->dropColumn('tax_type');
            }
            if (Schema::hasColumn('invoices', 'tax_value')) {
                $table->dropColumn('tax_value');
            }
            if (Schema::hasColumn('invoices', 'tax_amount')) {
                $table->dropColumn('tax_amount');
            }
            if (Schema::hasColumn('invoices', 'total_amount')) {
                $table->dropColumn('total_amount');
            }
        });
    }
};
