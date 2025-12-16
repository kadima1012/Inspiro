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
        Schema::create('order_artwork', function (Blueprint $table) {
            $table->id();
            $table->integer('idArt');
            $table->integer('idOrder');
            $table->integer('quantity_to_order');
            $table->foreign('idArt')->references('idArt')->on('artwork')->onDelete('cascade');
            $table->foreign('idOrder')->references('idOrder')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_artwork', function (Blueprint $table) {
            $table->dropForeign(['idArt']);
            $table->dropForeign(['idOrder']);
        });
        Schema::dropIfExists('order_artwork');
    }
};
