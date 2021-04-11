<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductModeOfTransportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_mode_of_transport', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';

            $table->bigInteger('product_id');
            $table->bigInteger('mode_of_transport_id');

            $table->foreign('product_id')
                ->references('id')->on('products');

            $table->foreign('mode_of_transport_id')
                ->references('id')->on('mode_of_transports');

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
        Schema::table('product_mode_of_transport', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['mode_of_transport_id']);
        });

        Schema::dropIfExists('product_mode_of_transport');
    }
}
