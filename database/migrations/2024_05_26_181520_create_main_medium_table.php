<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainMediumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_medium', function (Blueprint $table) {
            $table->integer('idArtist');
            $table->integer('Id_Tag_Medium');
            $table->primary(['idArtist', 'Id_Tag_Medium']); 
            
            $table->foreign('idArtist')->references('idArtist')->on('artist');
            $table->foreign('Id_Tag_Medium')->references('Id_Tag_Medium')->on('tag_medium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_medium');
    }
}
