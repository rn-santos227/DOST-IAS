<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnsubofformcontent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_content', function (Blueprint $table) {
            $table->string('subof')->after('auditfinding_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_content', function (Blueprint $table) {
            $table->string('subof')->after('auditfinding_no');
        });
    }
}
