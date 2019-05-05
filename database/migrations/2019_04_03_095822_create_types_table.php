<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('types')->insert([
            'name' => 'naisüksik'
        ]);

        DB::table('types')->insert([
            'name' => 'meesüksik'
        ]);

        DB::table('types')->insert([
            'name' => 'naispaar'
        ]);

        DB::table('types')->insert([
            'name' => 'meespaar'
        ]);

        DB::table('types')->insert([
            'name' => 'segapaar'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
