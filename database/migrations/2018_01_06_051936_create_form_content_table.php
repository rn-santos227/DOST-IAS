<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_content', function(Blueprint $table)
          {
               $table->increments('id');
               $table->string('form_001_id');
               $table->string('auditfinding_no');
               $table->string('author_id');
               $table->string('audit_area');
               $table->string('custom_auditarea');
               $table->string('sub_auditarea');
               $table->longText('auditfinding');
               $table->longText('auditrecommend');
               $table->longText('auditmanageaction');
               $table->string('action_by');
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
        Schema::drop('form_content');
    }
}
