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
            if (!Schema::hasColumn('invoices' , 'tax_type')) {
                $table->enum('tax_type', ['percentage', 'fixed'])->nullable()->default(null)->after('amount');
            }
            if (!Schema::hasColumn('invoices' , 'tax_value')) {
                $table->decimal('tax_value', 16, 2)->nullable()->default(0.00)->after('tax_type');
            }
            if (!Schema::hasColumn('invoices' , 'tax_amount')) {
                $table->decimal('tax_amount', 16, 2)->nullable()->default(0.00)->after('tax_value');
            }
            if (!Schema::hasColumn('invoices' , 'currency')) {
                $table->enum('currency', ['USD', 'GBP', 'AUD', 'CAD'])->nullable()->default('USD')->after('due_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
        });
    }
};
