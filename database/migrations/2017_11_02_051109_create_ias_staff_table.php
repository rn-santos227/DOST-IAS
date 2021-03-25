<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIasStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iasstaff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('title');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('position');
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
        Schema::dropIfExists('iasstaff');
    }
}
