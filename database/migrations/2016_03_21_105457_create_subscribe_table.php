<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('subscribe', function (Blueprint $table) {
             $table->integer('userID')->unsigned();
              $table->integer('channelID')->unsigned();
            $table->foreign('userID')->references('userID')->on('users');
            $table->foreign('channelID')->references('channelID')->on('channels');
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
       Schema::drop('favorites');
    }
}
