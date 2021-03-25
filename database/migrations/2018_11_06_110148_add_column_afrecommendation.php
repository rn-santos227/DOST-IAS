<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAfrecommendation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afrecommendation', function (Blueprint $table) {
            $table->longText('management_action')->after('afrecommend');
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
            $table->longText('management_action')->after('afrecommend');
        });
    }
}
