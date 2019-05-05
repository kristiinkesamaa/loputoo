<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('leagues')->insert([
            'name' => 'meistriliiga'
        ]);

        DB::table('leagues')->insert([
            'name' => 'esiliiga'
        ]);

        DB::table('leagues')->insert([
            'name' => 'Ⅱ. liiga'
        ]);

        DB::table('leagues')->insert([
            'name' => 'Ⅲ. liiga'
        ]);

        DB::table('leagues')->insert([
            'name' => 'Ⅳ. liiga'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
}
