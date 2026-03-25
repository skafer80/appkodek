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
        Schema::table('entities', function (Blueprint $table) {
            $table->foreignId('comune_id')->nullable()->constrained('comuni')->nullOnDelete()->after('comune');
            $table->foreignId('foro_comune_id')->nullable()->constrained('comuni')->nullOnDelete()->after('comune');
            $table->dropColumn('comune');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->dropForeign(['comune_id']);
            $table->dropColumn('comune_id');
            $table->string('comune')->nullable()->after('indirizzo');
        });
    }
};
