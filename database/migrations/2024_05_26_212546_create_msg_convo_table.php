<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgConvoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg_convos', function (Blueprint $table) {
            $table->integer('idMessage');
            $table->integer('Id_Conversation');
            $table->primary(['idMessage', 'Id_Conversation']);
        });

        Schema::table('msg_convos', function (Blueprint $table) {
            $table->foreign('idMessage')->references('idMessage')->on('msg');
            $table->foreign('Id_Conversation')->references('Id_Conversation')->on('convos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('msg_convos', function (Blueprint $table) {
            $table->dropForeign(['idMessage']);
            $table->dropForeign(['Id_Conversation']);
        });

        Schema::dropIfExists('msg_convos');
    }
}
