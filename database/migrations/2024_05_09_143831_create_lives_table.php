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
        Schema::create('lives', function (Blueprint $table) {
            $table->integer('idUser');
            $table->integer('idCity');
            $table->primary(['idUser', 'idCity']);
        });
        Schema::table('lives', function (Blueprint $table) {
            $table->foreign('idUser')->references('idUser')->on('users');
            $table->foreign('idCity')->references('idCity')->on('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lives');
    }
};
