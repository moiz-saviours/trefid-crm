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
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->string('action')->nullable()->default(null);
                $table->unsignedBigInteger('model_id')->nullable()->default(null);
                $table->string('model_type')->nullable()->default(null);
                $table->unsignedBigInteger('actor_id')->nullable()->default(null);
                $table->string('actor_type')->nullable()->default(null);
                $table->string('description')->nullable()->default(null);
                $table->longText('details')->nullable()->default(null);
                $table->string('ip_address')->nullable()->default(null);
                $table->softDeletes();
                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
