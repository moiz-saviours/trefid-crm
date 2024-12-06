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
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_key')->nullable()->default(null);
                $table->unsignedBigInteger('brand_key')->nullable()->default(null);
                $table->unsignedBigInteger('team_key')->nullable()->default(null);
                $table->unsignedBigInteger('client_key')->nullable()->default(null);
                $table->unsignedBigInteger('agent_id')->nullable()->default(null);

                $table->unsignedBigInteger('merchant_id')->nullable()->default(null);
                $table->string('merchant_name')->nullable()->default(null);

                $table->string('transaction_id')->nullable()->default(null);
                $table->longText('response')->nullable()->default(null);
                $table->longText('transaction_response')->nullable()->default(null);

                $table->decimal('amount', 16, 2)->nullable()->default(0.00);
                $table->tinyInteger('payment_type')->nullable()->default(0)->comment('0 = fresh, 1 = upsale');
                $table->tinyInteger('status')->nullable()->default(1)->comment('0 = due, 1 = paid , 2 = refund');
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('invoice_key')->references('invoice_key')->on('invoices')->onDelete('NO ACTION');
                $table->foreign('brand_key')->references('brand_key')->on('brands')->onDelete('NO ACTION');
                $table->foreign('team_key')->references('team_key')->on('teams')->onDelete('NO ACTION');
                $table->foreign('client_key')->references('client_key')->on('clients')->onDelete('NO ACTION');
                $table->foreign('agent_id')->references('id')->on('users')->onDelete('NO ACTION');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
