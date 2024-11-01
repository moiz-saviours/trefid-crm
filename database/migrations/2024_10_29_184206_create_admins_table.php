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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
            $table->enum('type', ['super-admin', 'admin', 'developer', 'editor', 'viewer'])->nullable()->default('admin');
            $table->rememberToken();
            $table->integer('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
