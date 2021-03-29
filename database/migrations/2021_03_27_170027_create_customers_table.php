<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';

            $table->bigInteger('id')->autoIncrement();

            $table->string('surname', 30)->nullable(false);
            $table->string('forename', 30)->nullable(false);
            $table->smallInteger('zipcode')->nullable(false);
            $table->string('city', 50)->nullable(false);
            $table->string('address', 50)->nullable(false);
            $table->string('phone')->nullable();
            $table->string('email', 50)->nullable(false);
            $table->string('password')->nullable(false);

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
        Schema::dropIfExists('customers');
    }
}
