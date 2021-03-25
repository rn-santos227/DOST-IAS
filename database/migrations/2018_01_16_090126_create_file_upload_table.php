<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileUpload', function(Blueprint $table)
          {
               $table->increments('id');
               $table->string('form_001_id');
               $table->string('auditfinding_no');
               $table->string('filename');
               $table->string('description');
               $table->string('file');
               $table->string('filetype');
               $table->string('uploaded_by');
               $table->string('status');
               $table->string('archive_status');
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
        Schema::drop('fileUpload');
    }
}
