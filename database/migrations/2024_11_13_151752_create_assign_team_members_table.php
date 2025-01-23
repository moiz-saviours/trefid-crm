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
        if (!Schema::hasTable('assign_team_members')) {
            Schema::create('assign_team_members', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('team_key')->nullable()->default(null);
                $table->unsignedBigInteger('user_id')->nullable()->default(null);
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('team_key')->references('team_key')->on('teams')->onDelete('cascade');

                $table->index('team_key');
                $table->index('user_id');
                $table->unique(['team_key', 'user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_team_members');
    }
};
