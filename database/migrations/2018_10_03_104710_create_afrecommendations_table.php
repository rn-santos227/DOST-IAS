<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfrecommendationsTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afrecommendation', function(Blueprint $table)
          {
               $table->increments('id');
               $table->string('form_001_id');
               $table->string('auditfinding_no');
               $table->string('subof_no');
               $table->string('author_id');
               $table->longText('afrecommend');
               $table->string('status');
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
        Schema::drop('afrecommendation');
    }
}
