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
//        if (!Schema::hasTable('invoices')) {
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('brand_key')->nullable()->default(null);
                $table->unsignedBigInteger('team_key')->nullable()->default(null);
                $table->unsignedBigInteger('client_key')->nullable()->default(null);
                $table->nullableMorphs('agent');
                $table->nullableMorphs('creator');
                $table->unsignedBigInteger('invoice_key')->nullable()->default(null)->unique();
                $table->string('invoice_number')->nullable()->default(null);
                $table->longText('description')->nullable()->default(null);
                $table->decimal('amount', 16, 2)->nullable()->default(0.00);
                $table->integer('type')->nullable()->default(0)->comment('0 = fresh, 1 = upsale');
                $table->integer('status')->nullable()->default(0)->comment('0 = due, 1 = paid');
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('brand_key')->references('brand_key')->on('brands')->onDelete('NO ACTION');
                $table->foreign('team_key')->references('team_key')->on('teams')->onDelete('NO ACTION');

            });
//        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
