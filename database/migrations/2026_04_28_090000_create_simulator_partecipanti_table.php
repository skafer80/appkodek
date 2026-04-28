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
        Schema::create('simulator_partecipanti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('simulator_player_id');
            $table->foreign('simulator_player_id')->references('id')->on('simulator_players')->onDelete('cascade');
            $table->unsignedBigInteger('classroom_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->string('t_codice_fiscale', 16);
            $table->boolean('b_disabile')->default(false);
            $table->string('t_r_provincia', 2);
            $table->string('t_r_comune');
            $table->string('t_d_provincia', 2)->nullable();
            $table->string('t_d_comune')->nullable();
            $table->unsignedTinyInteger('i_tipo_condizione_occupazionale_id');
            $table->timestamps();

            $table->unique(['simulator_player_id', 'classroom_id', 't_codice_fiscale'], 'sim_part_unique_cf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulator_partecipanti');
    }
};
