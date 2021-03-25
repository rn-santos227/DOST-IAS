<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFuColumnAfrecommendation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afrecommendation', function (Blueprint $table) {
            $table->string('fauthor_id');
            $table->longText('first_fu');
            $table->longText('ffu_mgmtaction');
            $table->string('ffu_status');
            $table->string('ffu_updated_at');

            $table->string('sauthor_id');
            $table->longText('second_fu');
            $table->longText('sfu_mgmtaction');
            $table->string('sfu_status');
            $table->string('sfu_updated_at');

            $table->string('tauthor_id');
            $table->longText('third_fu');
            $table->longText('tfu_mgmtaction');
            $table->string('tfu_status');
            $table->string('tfu_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afrecommendation', function (Blueprint $table) {
            $table->string('fauthor_id');
            $table->longText('first_fu');
            $table->longText('ffu_mgmtaction');
            $table->string('ffu_status');
            $table->string('ffu_updated_at');

            $table->string('sauthor_id');
            $table->longText('second_fu');
            $table->longText('sfu_mgmtaction');
            $table->string('sfu_status');
            $table->string('sfu_updated_at');

            $table->string('tauthor_id');
            $table->longText('third_fu');
            $table->longText('tfu_mgmtaction');
            $table->string('tfu_status');
            $table->string('tfu_updated_at');
        });
    }
}
