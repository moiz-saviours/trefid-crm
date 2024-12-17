<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('clients', 'loggable') && !Schema::hasColumn('clients', 'loggable_type')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->renameColumn('loggable', 'loggable_type');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('clients', 'loggable_type') && !Schema::hasColumn('clients', 'loggable')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->renameColumn('loggable_type', 'loggable');
            });
        }
    }
};
