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
        if (Schema::hasColumn('companies', 'loggable') && !Schema::hasColumn('companies', 'loggable_type')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->renameColumn('loggable', 'loggable_type');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('companies', 'loggable_type') && !Schema::hasColumn('companies', 'loggable')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->renameColumn('loggable_type', 'loggable');
            });
        }
    }
};
