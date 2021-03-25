<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency', function(Blueprint $table)
          {
               $table->increments('id');
               $table->string('name');
               $table->string('code');
               $table->string('agencygroup');
               $table->string('agencyhead');
               $table->string('emailhead');
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
        Schema::drop('agency');
    }
}
