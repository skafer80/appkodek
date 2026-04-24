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
        Schema::create('modulis', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('gruppo_moduli_id');
            $table->foreign('gruppo_moduli_id')->references('id')->on('gruppo_modulis')->onDelete('cascade');
            $table->unsignedBigInteger('formazione_id');
            $table->foreign('formazione_id')->references('id')->on('formaziones')->onDelete('cascade');
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
        Schema::dropIfExists('modulis');
    }
};
