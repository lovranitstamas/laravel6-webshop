<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrderStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_states', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';

            //change
            $table->bigInteger('product_id')->nullable(false)->after('order_id');

            //remove
            $table->dropForeign('order_states_customer_id_foreign');
            $table->dropColumn('customer_id');
            $table->dropColumn('total_amount');
            $table->dropForeign('order_states_coupon_id_foreign');
            $table->dropColumn('coupon_id');
            $table->dropColumn('completed');

            //add
            $table->foreign('product_id')
                ->references('id')->on('products')
                //->onDelete('cascade')
                ->onUpdate('cascade');
            $table->smallInteger('quantity')->nullable(false)->after('product_id');


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
            //remove
            $table->dropColumn('quantity');
            $table->dropForeign('order_states_product_id_foreign');
            $table->dropColumn('product_id');

            //add
            $table->bigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')
                ->references('id')->on('coupons')
                //->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('total_amount')->nullable(false);
            $table->bigInteger('customer_id')->nullable(false);
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                //->onDelete('cascade')
                ->onUpdate('cascade');
            $table->tinyInteger('completed')->default(0);


        });
    }
}
