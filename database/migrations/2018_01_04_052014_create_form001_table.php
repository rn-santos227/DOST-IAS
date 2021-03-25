<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForm001Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_001', function(Blueprint $table)
          {
               $table->increments('id');
               $table->string('audit_form_id');
               $table->string('agency_id');
               $table->string('pap');
               $table->string('supervisor');
               $table->string('tleader_id');
               $table->string('amember_id');
               $table->string('overseer');
               $table->string('secretariat_id');
               $table->string('datefrom');
               $table->string('dateto');
               $table->longText('scope_audit');
               $table->longText('auditees');
               $table->longText('background');
               $table->longText('goodpoint');
               $table->string('author_id');
               $table->string('status');
               $table->string('open');
               $table->string('close');
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
        Schema::drop('form_001');
    }
}
