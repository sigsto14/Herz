<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sounds', function (Blueprint $table) {
            $table->increments('soundID');
            $table->string('title')->unique();
            $table->string('URL');
            $table->string('podpicture');
            $table->string('tag');
            $table->string('status');
             $table->integer('channelID')->unsigned();
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
        //
    }
}
