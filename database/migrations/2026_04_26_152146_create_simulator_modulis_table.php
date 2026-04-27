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
        Schema::create('simulator_modulis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('simulator_player_id');
            $table->foreign('simulator_player_id')->references('id')->on('simulator_players')->onDelete('cascade');
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulis')->onDelete('cascade');
            $table->tinyInteger('ore_aula');
            $table->tinyInteger('ore_fad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulator_modulis');
    }
};
