<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artist', function (Blueprint $table) {
            $table->integer('idArtist')->autoIncrement()->primary();
            $table->integer('idUser');
            $table->string('artist_first_name', 50);
            $table->string('artist_last_name', 50);
            $table->string('artist_description', 512);
            $table->string('artist_email', 100);
            $table->string('artist_portofolio', 50)->nullable();
            $table->integer('artist_experience');
        });
        Schema::table('artist', function (Blueprint $table) {
            $table->foreign('idUser')->references('idUser')->on('users');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist');
    }
};
