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
        if (!Schema::hasTable('assign_brand_accounts')) {
            Schema::create('assign_brand_accounts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('brand_key')->nullable()->default(null);
                $table->string('assignable_type')->nullable()->default(null);
                $table->unsignedBigInteger('assignable_id')->nullable()->default(null);
                $table->timestamps();
                $table->foreign('brand_key')->references('brand_key')->on('brands')->onDelete('cascade');
                $table->index(['assignable_type', 'assignable_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_brand_accounts', function (Blueprint $table) {
            if (Schema::hasColumn('assign_brand_accounts', 'brand_key')) {
                $table->dropForeign(['brand_key']);
            }
        });
        Schema::dropIfExists('assign_brand_accounts');
    }
};
