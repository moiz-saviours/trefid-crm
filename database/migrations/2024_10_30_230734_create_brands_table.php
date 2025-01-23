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
        if (!Schema::hasTable('brands')) {
            Schema::create('brands', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('brand_key')->nullable()->default(null);

                $table->string('name')->nullable()->default(null);
                $table->string('url')->nullable()->default(null);
                $table->string('logo')->nullable()->default(null);
                $table->string('email')->nullable()->default(null);
                $table->text('description')->nullable()->default(null);

                $table->tinyInteger('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
                $table->softDeletes();
                $table->timestamps();

                $table->index('brand_key');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
