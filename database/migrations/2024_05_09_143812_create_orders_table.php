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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('idOrder')->autoIncrement()->primary();
            $table->integer('idUser');
            $table->integer('idArtist');
            $table->string('order_status', 50);
            $table->string('order_details', 255);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('idUser')->references('idUser')->on('users');
            $table->foreign('idArtist')->references('idArtist')->on('artist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
