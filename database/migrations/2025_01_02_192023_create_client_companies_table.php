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
        if (!Schema::hasTable('client_companies')) {
            Schema::create('client_companies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('special_key')->nullable()->default(null);
                $table->unsignedBigInteger('c_contact_key')->nullable()->default(null);
                $table->string('name')->nullable()->default(null);
                $table->string('logo')->nullable()->default(null);
                $table->string('url')->nullable()->default(null);
                $table->string('email')->nullable()->default(null);
                $table->text('description')->nullable()->default(null);
                $table->morphs('creator');
                $table->tinyInteger('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
                $table->softDeletes();
                $table->timestamps();
                $table->index('special_key');
                $table->index('c_contact_key');

                $table->foreign('c_contact_key')->references('special_key')->on('client_contacts')->onDelete('NO ACTION');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_companies');
    }
};
