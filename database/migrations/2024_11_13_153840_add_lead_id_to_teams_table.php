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
        Schema::table('teams', function (Blueprint $table) {
            if (!Schema::hasColumn('teams', 'lead_id')) {
                $table->unsignedBigInteger('lead_id')->nullable()->default(null);
                $table->foreign('lead_id')->references('id')->on('users')->onDelete('SET NULL');
                if (!Schema::hasIndex('teams', ['lead_id'], 'unique')) {
                    $table->index('lead_id');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            //
        });
    }
};
