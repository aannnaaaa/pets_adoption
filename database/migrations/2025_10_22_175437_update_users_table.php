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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['buyer', 'owner', 'shelter', 'admin'])->default('buyer')->after('password');
            $table->string('phone', 50)->nullable()->after('role');
            $table->string('city', 225)->nullable()->after('phone');
            $table->datetime('last_login')->nullable()->after('created_at');
            $table->dropColumn('email_verified_at');
            $table->dropRememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'city', 'last_login']);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }
};
