<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('roles')->after('email')->default('USER');
            $table->boolean('verified')->after('password')->default(0);
            $table->string('phone', 12)->after('password')->nullable();
            $table->string('address')->after('password')->nullable();
            $table->string('bank_acc', 20)->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roles');
            $table->dropColumn('verified');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('bank_acc');
        });
    }
}
