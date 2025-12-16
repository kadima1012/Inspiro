<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtMediumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art_medium', function (Blueprint $table) {
            $table->integer('idArt');
            $table->integer('Id_Tag_Medium');
            $table->primary(['idArt', 'Id_Tag_Medium']); 
            
            $table->foreign('idArt')->references('idArt')->on('artwork');
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
        Schema::dropIfExists('art_medium');
    }
}
