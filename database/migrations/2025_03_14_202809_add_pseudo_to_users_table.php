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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'pseudo_name')) {
                $table->string('pseudo_name')->nullable()->default(null)->after('name');
            }
            if (!Schema::hasColumn('users', 'pseudo_email')) {
                $table->string('pseudo_email')->nullable()->default(null)->after('email');
            }
            if (!Schema::hasColumn('users', 'pseudo_phone')) {
                $table->string('pseudo_phone')->nullable()->default(null)->after('phone_number');
            }
            if (!Schema::hasColumn('users', 'date_of_joining')) {
                $table->date('date_of_joining')->nullable()->default('2000-01-01')->after('dob');
            }
            if (!Schema::hasColumn('users', 'last_ip_address')) {
                $table->ipAddress('last_ip_address')->nullable()->default(null)->after('last_seen');
            }
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable()->default(null)->after('city');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'pseudo_name')) {
                $table->dropColumn('pseudo_name');
            }
            if (Schema::hasColumn('users', 'pseudo_email')) {
                $table->dropColumn('pseudo_email');
            }
            if (Schema::hasColumn('users', 'pseudo_phone')) {
                $table->dropColumn('pseudo_phone');
            }
            if (Schema::hasColumn('users', 'date_of_joining')) {
                $table->dropColumn('date_of_joining');
            }
            if (Schema::hasColumn('users', 'last_ip_address')) {
                $table->dropColumn('last_ip_address');
            }
        });
    }
};
