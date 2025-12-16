<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventParticipationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participation', function (Blueprint $table) {
            $table->integer('idEventParticipation')->autoIncrement()->primary();
            $table->integer('idUser');
            $table->integer('IdEvents');
            $table->string('participation_status', 50);
            $table->timestamps();
        });
        Schema::table('event_participation', function (Blueprint $table) {
            $table->foreign('idUser')->references('idUser')->on('users');
            $table->foreign('IdEvents')->references('IdEvents')->on('events');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_participation');
    }
}

