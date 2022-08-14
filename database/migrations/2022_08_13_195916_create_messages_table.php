<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            // $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->timestamps();


            $table->unsignedInteger('user_id')->unsaigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('user_id')
        //     ->references('id')
        //     ->on('users')
        //     ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
