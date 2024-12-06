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
        if (!Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('brand_key')->nullable()->default(null);
                $table->unsignedBigInteger('team_key')->nullable()->default(null);
                $table->unsignedBigInteger('client_key')->nullable()->default(null);
                $table->unsignedBigInteger('lead_status_id')->nullable()->default(null);
                $table->string('name')->nullable()->default(null);
                $table->string('email')->unique();
                $table->string('phone')->nullable()->default(null);
                $table->string('address')->nullable()->default(null);
                $table->string('city')->nullable()->default(null);
                $table->string('state')->nullable()->default(null);
                $table->string('country')->nullable()->default(null);
                $table->string('zipcode')->nullable()->default(null);
                $table->text('note')->nullable()->default(null);
                $table->integer('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
                $table->softDeletes();
                $table->timestamps();


                $table->foreign('brand_key')->references('brand_key')->on('brands')->onDelete('NO ACTION');
                $table->foreign('team_key')->references('team_key')->on('teams')->onDelete('NO ACTION');
                $table->foreign('client_key')->references('client_key')->on('clients')->onDelete('NO ACTION');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
