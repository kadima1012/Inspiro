<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagMediumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_medium', function (Blueprint $table) {
            //$table->id('Id_Tag_Medium'); 
            $table->integer('Id_Tag_Medium')->autoIncrement()->primary();
            $table->string('medium_name', 50);
            $table->string('medium_description', 50)->nullable(); 
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
        Schema::dropIfExists('tag_medium');
    }
}
