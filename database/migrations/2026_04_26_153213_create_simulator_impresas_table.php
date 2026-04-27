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
        Schema::create('simulator_impresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('simulator_player_id');
            $table->foreign('simulator_player_id')->references('id')->on('simulator_players')->onDelete('cascade');
            $table->unsignedBigInteger('classroom_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->string('denominazione');
            $table->string('partita_iva');
            $table->string('indirizzo');
            $table->string('numero_civico');
            $table->string('cap')->nullable();
            $table->unsignedBigInteger('comune_id')->nullable();
            $table->foreign('comune_id')->references('id')->on('comuni')->onDelete('set null');
            $table->smallInteger('numero_allievi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulator_impresas');
    }
};
