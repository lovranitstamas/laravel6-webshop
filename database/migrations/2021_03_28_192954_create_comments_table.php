<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';

            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('customer_id')->nullable(false);
            $table->bigInteger('product_id')->nullable(false);
            $table->text('content')->nullable(false);

            $table->timestamps();

            /*
            * Constraints
            * */
            $table->foreign('customer_id','customer_id')
                ->references('id')->on('customers')
                //->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id','product_id')
                ->references('id')->on('products')
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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['customer_id', 'product_id']);
        });

        Schema::dropIfExists('comments');
    }
}
