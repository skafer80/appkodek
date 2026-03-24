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
        Schema::create('click_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('id_subject');
            $table->string('nome')->nullable();
            $table->integer('ore_conoscenza')->default(0);
            $table->integer('ore_fad_conoscenza')->default(0);
            $table->integer('gruppo')->default(0);
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
        Schema::dropIfExists('click_subjects');
    }
};
