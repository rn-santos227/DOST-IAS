<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table)
          {
               $table->increments('id');
               $table->string('form_001_id');
               $table->string('auditfinding_no');
               $table->longText('comment');
               $table->string('comment_type');
               $table->longText('comment_by');
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
        Schema::drop('comments');
    }
}
