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
        Schema::create('simulator_personales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('simulator_player_id');
            $table->foreign('simulator_player_id')->references('id')->on('simulator_players')->onDelete('cascade');
            $table->unsignedBigInteger('classroom_id');
            $table->foreign('classroom_id')->references('id')->on('simulator_classrooms')->onDelete('cascade');
            $table->string('nome');
            $table->string('cognome');
            $table->string('cf');
            $table->string('telefono');
            $table->string('email');
            $table->date('data_nascita');
            $table->string('ruolo');
            $table->boolean('esterno')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulator_personales');
    }
};
