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
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'domain')) {
                $table->string('domain')->nullable()->default(null)->after('company_key');
            }
            if (!Schema::hasColumn('companies', 'response')) {
                $table->json('response')->nullable()->default(null)->after('zipcode');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'domain')) {
                $table->dropColumn('domain');
            }
            if (Schema::hasColumn('companies', 'response')) {
                $table->dropColumn('response');
            }
        });
    }
};
