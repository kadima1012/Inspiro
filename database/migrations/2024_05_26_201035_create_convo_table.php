<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('convos', function (Blueprint $table) {
            //$table->increments('Id_Conversation');
            $table->integer('Id_Conversation')->autoIncrement()->primary();
            $table->boolean('User1_Autorized');
            $table->boolean('User2_Autorized');
            $table->integer('idUser');  
            $table->integer('idUser_1');  
            $table->timestamps();
        });

        Schema::table('convos', function (Blueprint $table) {
            $table->foreign('idUser')->references('idUser')->on('users');
            $table->foreign('idUser_1')->references('idUser')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('convos', function (Blueprint $table) {
            $table->dropForeign(['idUser']);
            $table->dropForeign(['idUser_1']);
        });

        Schema::dropIfExists('convos');
    }
}
