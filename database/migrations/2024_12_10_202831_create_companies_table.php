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
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_key')->nullable()->default(null)->unique();
                $table->string('name')->nullable()->default(null);
                $table->string('email')->unique();
                $table->string('phone')->nullable()->default(null);
                $table->string('address')->nullable()->default(null);
                $table->string('city')->nullable()->default(null);
                $table->string('state')->nullable()->default(null);
                $table->string('country')->nullable()->default(null);
                $table->string('zipcode')->nullable()->default(null);
                $table->string('loggable')->nullable()->default(null);
                $table->unsignedBigInteger('loggable_id')->nullable()->default(null);
                $table->integer('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
                $table->softDeletes();
                $table->timestamps();

                $table->index('company_key');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
