<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            //$table->bigIncrements('id');
            //$table->string('id')->primary()->index();
            $table->bigInteger('id')->autoIncrement();

            $table->dateTime('valid_from')->nullable(false);
            $table->dateTime('valid_to')->nullable(false);
            $table->tinyInteger('state')->default(true);
            $table->smallInteger('discount')->nullable(false);

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
        Schema::dropIfExists('coupons');
    }
}
