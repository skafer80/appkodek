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
        Schema::create('click_students', function (Blueprint $table) {
            $table->id();
            $table->date('d_ammesso_selezione');
            $table->string('t_nome');
            $table->string('t_cognome');
            $table->string('t_sesso');
            $table->boolean('b_disabile');
            $table->date('d_nascita');
            $table->string('t_n_provincia');
            $table->string('t_n_comune');
            $table->string('t_n_altro_comune')->nullable();
            $table->string('t_codice_fiscale');
            $table->integer('i_cittadinanza_id');
            $table->string('t_r_provincia');
            $table->string('t_r_comune');
            $table->string('t_d_provincia')->nullable();
            $table->string('t_d_comune')->nullable();
            $table->integer('i_tipo_titolo_studio_id');
            $table->integer('i_tipo_condizione_occupazionale_id');
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('click_students');
    }
};
