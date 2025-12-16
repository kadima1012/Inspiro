<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainStyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_style', function (Blueprint $table) {
            $table->integer('idArtist');
            $table->integer('Id_Tag_Style');
            $table->primary(['idArtist', 'Id_Tag_Style']);
            
            $table->foreign('idArtist')->references('idArtist')->on('artist');
            $table->foreign('Id_Tag_Style')->references('Id_Tag_Style')->on('tag_style');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_style');
    }
}
