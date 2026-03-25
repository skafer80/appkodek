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
        Schema::table('medical_examinations', function (Blueprint $table) {
            $table->foreignId('entity_id')->nullable()->constrained()->nullOnDelete()->after('id');
            $table->renameColumn('risultato', 'note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_examinations', function (Blueprint $table) {
            $table->dropForeign(['entity_id']);
            $table->dropColumn('entity_id');
            $table->renameColumn('note', 'risultato');
        });
    }
};
