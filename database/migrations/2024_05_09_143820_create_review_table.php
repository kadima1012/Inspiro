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
        Schema::create('review', function (Blueprint $table) {
            $table->integer('idReview')->autoIncrement()->primary();
            $table->integer('idUser');
            $table->integer('idArtwork');
            $table->integer('review_score');
            $table->string('review_comment', 255);
        });
        Schema::table('review', function (Blueprint $table) {
            $table->foreign('idUser')->references('idUser')->on('users');
            $table->foreign('idArtwork')->references('idArt')->on('artwork');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
