<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnotherColumnAfrecommendation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afrecommendation', function (Blueprint $table) {
            $table->string('ffumgmt_updated_at')->after('ffu_updated_at');
            $table->string('sfumgmt_updated_at')->after('sfu_updated_at');
            $table->string('tfumgmt_updated_at')->after('tfu_updated_at');
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
            $table->string('ffumgmt_updated_at')->after('ffu_updated_at');
            $table->string('sfumgmt_updated_at')->after('sfu_updated_at');
            $table->string('tfumgmt_updated_at')->after('tfu_updated_at');
        });
    }
}
