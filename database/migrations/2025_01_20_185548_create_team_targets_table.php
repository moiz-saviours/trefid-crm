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
        if (!Schema::hasTable('team_targets')) {
            Schema::create('team_targets', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('special_key')->nullable()->default(null)->unique();
                $table->unsignedBigInteger('team_key')->nullable()->default(null);
                $table->morphs('creator');
                $table->decimal('target_amount', 16, 2)->nullable()->default(0.00);
                $table->tinyInteger('month');
                $table->year('year');
                $table->integer('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
                $table->softDeletes();
                $table->timestamps();

                $table->index('special_key');
                $table->unique(['team_key', 'month', 'year']);

                $table->foreign('team_key')->references('team_key')->on('teams')->onDelete('NO ACTION');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_targets');
    }
};
