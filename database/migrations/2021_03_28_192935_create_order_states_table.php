<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_states', function (Blueprint $table) {

            $table->string('id')->primary()->index();
            $table->bigInteger('customer_id')->nullable(false);
            $table->integer('total_amount')->nullable(false);
            $table->bigInteger('coupon_id')->nullable();
            $table->tinyInteger('completed')->default(0);

            $table->timestamps();

            /*
            * Constraints
            * */
            /*$table->foreign('id')
                ->references('id')->on('orders')
                //->onDelete('cascade')
                ->onUpdate('cascade');*/

            $table->foreign('customer_id')
                ->references('id')->on('customers')
                //->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('coupon_id')
                ->references('id')->on('coupons')
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
        Schema::table('order_states', function (Blueprint $table) {
            //$table->dropIndex(['id']);
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['coupon_id']);
        });

        Schema::dropIfExists('order_states');
    }
}
