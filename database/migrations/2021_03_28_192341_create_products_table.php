<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';

            $table->bigInteger('id')->autoIncrement();
            $table->string('name_hu', 50)->nullable(false);
            $table->tinyInteger('state')->default(1);       //státusz
            $table->smallInteger('inventory')->default(0); //raktárkészlet
            $table->integer('price_hu')->nullable(false);
            $table->string('payment_unit', 10)->nullable(false);
            $table->bigInteger('mode_of_transport_id')->nullable(false);

            $table->timestamps();

            /*
            * Constraints
            * */
            $table->foreign('mode_of_transport_id','mode_of_transport_id')
                ->references('id')->on('mode_of_transports')
                //->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['mode_of_transport_id']);
        });

        Schema::dropIfExists('products');
    }
}
