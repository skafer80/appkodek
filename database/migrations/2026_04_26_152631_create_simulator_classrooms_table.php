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
        Schema::create('simulator_classrooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('simulator_player_id');
            $table->foreign('simulator_player_id')->references('id')->on('simulator_players')->onDelete('cascade');
            $table->unsignedBigInteger('classroom_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->date('data_avvio');
            $table->date('data_fine');
            $table->float('importo');
            $table->integer('totale_giornate');
            $table->date('data_avvio_stage')->nullable();
            $table->date('data_fine_stage')->nullable();
            $table->smallInteger('totale_giornate_stage')->nullable();
            $table->smallInteger('fascia_a')->nullable();
            $table->smallInteger('fascia_b')->nullable();
            $table->smallInteger('fascia_c')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulator_classrooms');
    }
};
