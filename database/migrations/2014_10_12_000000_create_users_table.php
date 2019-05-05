<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'Demo Demo',
            'email' => 'demo@demo.ee',
            'email_verified_at' => '2019-04-10 08:56:49',
            'password' => '$2y$10$9vHgfAKLOqKvMSv7ZTCuseys7rRUZFDtRfY346iGK3qk1fct6inLC',
            'remember_token' => null,
            'created_at' => '2019-04-10 08:56:49',
            'updated_at' => '2019-04-10 08:56:49',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
