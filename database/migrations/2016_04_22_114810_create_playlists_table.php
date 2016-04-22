<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
   {
          Schema::create('playlists', function (Blueprint $table) {
             $table->increments('listID');
             $table->integer('userID')->unsigned();
             $table->string('soundIDs');
              $table->string('listTitle');
              $table->string('listDescription');
            $table->foreign('userID')->references('userID')->on('users');
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
