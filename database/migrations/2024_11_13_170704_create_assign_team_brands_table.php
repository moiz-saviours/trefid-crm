<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Matheus Daniel Update
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('assign_team_brands')) {
            Schema::create('assign_team_brands', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('team_key')->nullable()->default(null);
                $table->unsignedBigInteger('brand_key')->nullable()->default(null);
                $table->timestamps();

                $table->foreign('team_key')->references('team_key')->on('teams')->onDelete('cascade');
                $table->foreign('brand_key')->references('brand_key')->on('brands')->onDelete('cascade');

                $table->index('team_key');
                $table->index('brand_key');
                $table->unique(['team_key', 'brand_key']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_team_brands');
    }
};
