<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('users_id');
            $table->string('title', 70);
            $table->text('description');
            $table->string('status')->default('UNVERIFIED');
            $table->integer('target')->default(0);
            $table->date('deadline');
            $table->integer('total_donation')->default(0);
            $table->integer('count_donation')->default(0);
            $table->string('cover_img');

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
        Schema::dropIfExists('campaigns');
    }
}
