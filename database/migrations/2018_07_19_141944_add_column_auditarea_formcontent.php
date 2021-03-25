<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAuditareaFormcontent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_content', function (Blueprint $table) {
            $table->string('main_area');
            $table->string('custom_subauditarea');
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
            $table->string('main_area')->after('author_id');
            $table->string('custom_subauditarea')->after('sub_auditarea');
        });
    }
}
