<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artwork', function (Blueprint $table) {
            $table->integer('idArt')->autoIncrement()->primary();
            $table->integer('idArtist');
            $table->integer('idArtworkType');
            $table->string('art_Title', 50);
            $table->string('art_Description', 512);
            $table->boolean('art_Visible');
            $table->date('art_creation_date');
            $table->string('filepath');
            $table->string('art_Status', 50);
            $table->integer('art_quantity');


        });
        Schema::table('artwork', function (Blueprint $table) {
            $table->foreign('idArtist')->references('idArtist')->on('artist');
            $table->foreign('idArtworkType')->references('idArtworkType')->on('artwork_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artwork');
    }
};
