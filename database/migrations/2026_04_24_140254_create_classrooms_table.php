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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('indirizzo');
            $table->string('numero_civico');
            $table->string('cap');
            $table->string('citta');
            $table->string('provincia');
            $table->smallInteger('totale_ore');
            $table->unsignedBigInteger('formazione_id');
            $table->foreign('formazione_id')->references('id')->on('formaziones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
