<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name')->unique()->after('email');
            $table->string('first_name')->nullable()->after('user_name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('nick_name')->nullable()->after('last_name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_name', 'first_name', 'last_name', 'nick_name']);
        });
    }
}
