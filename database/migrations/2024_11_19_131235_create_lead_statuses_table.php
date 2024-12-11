<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Matheus Daniel Update
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('lead_statuses')) {
            Schema::create('lead_statuses', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->text('description')->nullable()->default(null);
                $table->string('color', 10)->nullable()->default('#FFFFFF')->comment('Hex or RGBA color code with optional alpha');
                $table->tinyInteger('status')->nullable()->default(1)->comment('0 = inactive, 1 = active');
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if (Schema::hasColumn('leads', 'lead_status_id') && !$this->foreignKeyExists('leads', 'lead_status_id')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->foreign('lead_status_id')->references('id')->on('lead_statuses')->onDelete('NO ACTION');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'lead_status_id') && $this->foreignKeyExists('leads', 'lead_status_id')) {
                $table->dropForeign(['lead_status_id']);
            }
        });
        Schema::dropIfExists('lead_statuses');
    }

    /**
     * Check if a foreign key exists in the given table.
     *
     * @param string $table
     * @param string $foreignKeyColumn
     * @return bool
     */
    protected function foreignKeyExists(string $table, string $foreignKeyColumn): bool
    {
        $foreignKeys = DB::select("SHOW KEYS FROM $table WHERE Column_name = '$foreignKeyColumn' AND Key_name != 'PRIMARY'");

        return count($foreignKeys) > 0;
    }
};
