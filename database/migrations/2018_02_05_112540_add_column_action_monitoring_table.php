<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnActionMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_monitoring', function (Blueprint $table) {
            $table->string('immgtaction_date')->after('imanagement_action');
            $table->string('fmmgtaction_date')->after('fmanagement_action');
            $table->string('smmgtaction_date')->after('smanagement_action');
            $table->string('tmmgtaction_date')->after('tmanagement_action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_monitoring', function (Blueprint $table) {
            $table->string('immgtaction_date');
            $table->string('fmmgtaction_date');
            $table->string('smmgtaction_date');
            $table->string('tmmgtaction_date');
        });
    }
}
