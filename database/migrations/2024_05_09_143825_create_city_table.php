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
        Schema::create('city', function (Blueprint $table) {
            $table->integer('idCity')->autoIncrement()->primary();
            $table->string('city_name', 50);
            $table->integer('idCountry');
            $table->integer('city_PC'); 
        });
    
        Schema::table('city', function (Blueprint $table) {
            $table->foreign('idCountry')->references('idCountry')->on('country');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city');
    }
};
