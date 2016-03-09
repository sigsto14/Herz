<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('commentID');
            $table->string('comment');
             $table->integer('userID')->unsigned();
              $table->integer('soundID')->unsigned();
             $table->foreign('userID')->references('userID')->on('users');
             $table->foreign('soundID')->references('soundID')->on('sounds');
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
         Schema::drop('comments');
    }
}
