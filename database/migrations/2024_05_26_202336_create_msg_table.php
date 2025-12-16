<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg', function (Blueprint $table) {
            $table->integer('idMessage')->autoIncrement()->primary();
            $table->integer('senderID');
            $table->string('message_content', 512);
            $table->string('timestamps', 50);
            $table->integer('idUser');
            $table->timestamps();
        });

        Schema::table('msg', function (Blueprint $table) {
            $table->foreign('idUser')->references('idUser')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msg');
    }
}
