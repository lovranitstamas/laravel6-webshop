<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->bigInteger('id')->autoIncrement();

            $table->string('attachable_type');
            $table->integer('attachable_id')->nullable();

            $table->string('path');
            $table->string('filename',100);
            $table->integer('size')->nullable();
            $table->string('original_filename',100)->nullable();
            $table->string('mimetype',50)->nullable();

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
        Schema::dropIfExists('attachments');
    }
}
