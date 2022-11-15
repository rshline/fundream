<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('campaigns_id');
            $table->bigInteger('users_id');
            $table->integer('nominal');
            $table->string('message')->nullable();
            $table->boolean('is_verified');
            $table->boolean('is_anon');
            $table->string('donation_method');
            $table->string('proof_img');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
