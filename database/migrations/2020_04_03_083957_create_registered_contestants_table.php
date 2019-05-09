<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredContestantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_contestants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('team_id');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
            $table->foreign('team_id')->references('id')->on('registered_teams')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registered_users');
    }
}
