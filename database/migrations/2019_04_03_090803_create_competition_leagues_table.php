<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_leagues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('league_id');
            $table->timestamps();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete("cascade");
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
        Schema::dropIfExists('competition_leagues');
    }
}
