<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyModeOfTransportAddExtraCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mode_of_transports', function (Blueprint $table) {
            $table->integer('extra_cost')->nullable()->after('mode_hu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mode_of_transports', function (Blueprint $table) {
            $table->dropColumn('extra_cost');
        });
    }
}
