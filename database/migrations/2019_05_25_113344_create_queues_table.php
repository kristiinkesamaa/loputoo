<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_1_id');
            $table->unsignedBigInteger('team_2_id');
            $table->integer('queue_number');
            $table->timestamps();
            $table->foreign('team_1_id')->references('id')->on('registered_teams')->onDelete("cascade");
            $table->foreign('team_2_id')->references('id')->on('registered_teams')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queues');
    }
}
