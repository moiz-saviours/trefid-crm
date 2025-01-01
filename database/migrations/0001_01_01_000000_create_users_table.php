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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('team_key')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('designation')->nullable()->default(null);
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('image')->nullable()->default(null);
            $table->string('phone_number')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('postal_code')->nullable()->default(null);
            $table->integer('age')->nullable()->default(18);
            $table->date('dob')->nullable()->default('2000-01-01');
            $table->string('about')->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('type', ['lead', 'sales', 'ppc',])->default('sales');
            $table->integer('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
            $table->timestamp('last_seen')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->index('id');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Schema::create('sessions', function (Blueprint $table) {
        //     $table->string('id')->primary();
        //     $table->foreignId('user_id')->nullable()->index();
        //     $table->string('ip_address', 45)->nullable();
        //     $table->text('user_agent')->nullable();
        //     $table->longText('payload');
        //     $table->integer('last_activity')->index();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
