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
        if (!Schema::hasTable('customer_notes')) {
            Schema::create('customer_notes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cus_contact_key')->nullable()->default(null);
                $table->string('note')->nullable()->default(null);
                $table->nullableMorphs('creator');
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('cus_contact_key')->references('special_key')->on('customer_contacts')->onDelete('NO ACTION');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_notes');
    }
};
