<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_list', function (Blueprint $table) {
            $table->integer('idArt');
            $table->integer('idArtist');
            $table->decimal('item_price', 10, 2); 
            $table->integer('quantity_for_sale');
            $table->primary(['idArt', 'idArtist']);
            
            $table->foreign('idArt')->references('idArt')->on('artwork');
            $table->foreign('idArtist')->references('idArtist')->on('artist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_list');
    }
}
