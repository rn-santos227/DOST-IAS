<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersEncoderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encoder', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
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
        Schema::dropIfExists('encoder');
    }
}
