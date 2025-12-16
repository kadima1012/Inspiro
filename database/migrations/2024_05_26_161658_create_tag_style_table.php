<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagStyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_style', function (Blueprint $table) {
            //$table->id('Id_Tag_Style'); 
            $table->integer('Id_Tag_Style')->autoIncrement()->primary();
            $table->string('style_description', 50);
            $table->string('style_name', 50);
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
        Schema::dropIfExists('tag_style');
    }
}
