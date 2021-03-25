<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_monitoring', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_001_id');
            $table->string('auditfinding_no');
            $table->string('idate');
            $table->longText('imanagement_action');
            $table->longText('imonitoring_mgtaction');
            $table->string('istatus');
            $table->string('iauthor');
            $table->string('fdate');
            $table->longText('fmanagement_action');
            $table->longText('fmonitoring_mgtaction');
            $table->string('fstatus');
            $table->string('fauthor');
            $table->string('sdate');
            $table->longText('smanagement_action');
            $table->longText('smonitoring_mgtaction');
            $table->string('sstatus');
            $table->string('sauthor');
            $table->string('tdate');
            $table->longText('tmanagement_action');
            $table->longText('tmonitoring_mgtaction');
            $table->string('tstatus');
            $table->string('tauthor');
            $table->string('monitoring_stage');
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
        Schema::dropIfExists('action_monitoring');
    }
}
