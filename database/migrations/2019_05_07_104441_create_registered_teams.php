<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('subgroup_id')->default(0);
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete("cascade");
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('league_id')->references('id')->on('leagues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registered_teams');
    }
}
